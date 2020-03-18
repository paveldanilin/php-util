<?php

use PHPUnit\Framework\TestCase;
use paveldanilin\PhpUtil\Hashtable;

class HashtableTest extends TestCase
{
    public function testArrayAccessSetKey()
    {
        $table = Hashtable::create();
        $table['myValue'] = 3350;
        $this->assertSame(3350, $table->get('myValue'));
    }

    public function testArrayAccessCheckKey()
    {
        $table = Hashtable::create();
        $table['myValue'] = 3350;
        $this->assertSame(true, isset($table['myValue']));
    }

    public function testArrayAccessUnsetKey()
    {
        $table = Hashtable::create();
        $table['name'] = 'Peter';
        unset($table['name']);
        $this->assertSame(0, $table->count());
    }

    public function testGetTypedKeys()
    {
        $user = Hashtable::create([
            'name' => 'Peter',
            'age' => '35',
            'logged' => 'false',
            'userInfo' => [
                'metadata' => [
                    'policies' => ['default']
                ]
            ]
        ]);

        $policies = Hashtable::create($user->getPath('userInfo.metadata.policies', []));

        $this->assertSame('Peter', $user->getAlnum('name'));
        $this->assertSame(35, $user->getInt('age'));
        $this->assertSame(false, $user->getBool('logged'));
        $this->assertSame(true, $policies->hasValue('default'));
    }

    public function testHasPath()
    {
        $table = Hashtable::create();
        $table['root'] = [
            'cars' => [
                'models' => [
                    'Toyota' => ['Camry', 'Vitz', 'Prado'],
                    'Honda' => ['Civic', 'HRV'],
                    'KIA' => ['Rio', 'Sportage', 'Sorento'],
                ],
            ],
        ];
        $this->assertSame(true, $table->hasPath('root.cars.models'));
    }
}
