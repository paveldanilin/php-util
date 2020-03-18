<?php

use PHPUnit\Framework\TestCase;
use paveldanilin\PhpUtil\Json;

class JsonTest extends TestCase
{
    public function testDecodeToArray()
    {
        $decoded = Json::toArray('{"a": {"b": {"c": 123}}}');
        $this->assertIsArray($decoded);
        $this->assertSame(123, $decoded['a']['b']['c']);
    }

    public function testDecodeToObject()
    {
        $decoded = Json::toObject('{"a": {"b": {"c": 123}}}');
        $this->assertIsObject($decoded);
        $this->assertSame(123, $decoded->a->b->c);
    }

    public function testDecodeBadJson()
    {
        $this->expectException(JsonException::class);
        Json::decode('{][/"av"', true);
    }

    public function testEncode()
    {
        $data = [
            'a' => [
                'array' => [1, 2, 3]
            ]
        ];
        $json = Json::encode($data);
        $this->assertSame('{"a":{"array":[1,2,3]}}', $json);
    }
}
