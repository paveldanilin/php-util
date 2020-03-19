<?php

use PHPUnit\Framework\TestCase;
use paveldanilin\PhpUtil\Arr;

class ArrTest extends TestCase
{
    public function testFind()
    {
        $data = [
            'a' => [
                'b' => [
                    'c' => 123
                ]
            ]
        ];
        $val = Arr::find('a.b.c', $data);
        $this->assertSame(123, $val);
    }

    public function testPartialFindException()
    {
        $this->expectException(\OutOfRangeException::class);
        $data = [
            'a' => 1,
            'b' => 2,
            'c' => 3,
        ];
        Arr::find('a.b.c', $data);
    }

    public function testFindException()
    {
        $this->expectException(\OutOfRangeException::class);
        Arr::find('a.b.c', []);
    }

    public function testGet()
    {
        $data = [
            'a' => [
                'b' => [
                    'welcome' => 'Hello, World!'
                ]
            ]
        ];
        $val = Arr::get('a.b.welcome', $data, 'Default welcome');
        $this->assertSame('Hello, World!', $val);
    }

    public function testGetDefault()
    {
        $temperature = Arr::get('sys.measures.temperature', [], -35);
        $this->assertSame(-35, $temperature);
    }

    public function testGetDefaultNull()
    {
        $defNull = Arr::get('a.b.c.d', []);
        $this->assertSame(null, $defNull);
    }

    public function testSetValue()
    {
        $myData = Arr::set('a.b.c', 5);
        $this->assertSame(true, Arr::has('a.b.c', $myData));
    }
}
