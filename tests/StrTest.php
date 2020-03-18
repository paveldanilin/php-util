<?php

use PHPUnit\Framework\TestCase;
use paveldanilin\PhpUtil\Str;

class StrTest extends TestCase
{
    public function testStartsWith()
    {
        $this->assertSame(true, Str::startsWith('Hello, World', 'Hello'));
    }

    public function testStartsWithCaseIgnore()
    {
        $this->assertSame(true, Str::startsWith('Hello, World', 'hello', false));
    }

    public function testDoesNotStartWith()
    {
        $this->assertSame(false, Str::startsWith('Hello, World', 'cat'));
    }

    public function testEndsWith()
    {
        $this->assertSame(true, Str::endsWith('Test string', 'string'));
    }

    public function testEndsWithCaseIgnore()
    {
        $this->assertSame(true, Str::endsWith('Test STRING', 'StrInG', false));
    }

    public function testDoesNotEndWith()
    {
        $this->assertSame(false, Str::endsWith('Test string', 'Space shuttle'));
    }

    public function testLastChunk()
    {
        $this->assertSame('dd', Str::lastChunk('aa.bb.cc.dd', '.'));
        $this->assertSame('dd', Str::lastChunk('aa/bb/cc/dd', '/'));
        $this->assertSame('dd', Str::lastChunk('aa\bb\cc\dd', '\\'));
    }

    public function testContains()
    {
        $contains = Str::contains('Hello, World!', 'Wo');
        $this->assertSame(true, $contains);
    }

    public function testDoesNotContain()
    {
        $contains = Str::contains('Hello, World!', 'wo');
        $this->assertSame(false, $contains);
    }

    public function testContainsCaseIgnore()
    {
        $contains = Str::contains('Hello, World!', 'WO', false);
        $this->assertSame(true, $contains);
    }
}
