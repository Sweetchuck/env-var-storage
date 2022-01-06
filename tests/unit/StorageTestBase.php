<?php

declare(strict_types = 1);

namespace Sweetchuck\EnvVarStorage\Tests\Unit;

use Codeception\Test\Unit;
use Sweetchuck\EnvVarStorage\EnvVarStorageInterface;
use Sweetchuck\EnvVarStorage\Tests\UnitTester;

class StorageTestBase extends Unit
{
    protected UnitTester $tester;

    protected EnvVarStorageInterface $storage;

    protected array $initialValues = [];

    public function testAllInOne()
    {
        $this->tester->assertSame(
            0,
            $this->storage->count() - count($this->initialValues),
            'storage is empty',
        );

        $this->storage->put('A=a');
        $this->storage['B'] = 'b';
        $this->storage->putAssoc('C', 'c');
        $this->storage->putMultipleAssignment(['D=d', 'E=e']);
        $this->storage->putMultipleAssoc(['F' => 'f', 'G' => 'g']);
        $this->tester->assertSame(
            [
                'A' => 'a',
                'B' => 'b',
                'C' => 'c',
                'D' => 'd',
                'E' => 'e',
                'F' => 'f',
                'G' => 'g',
            ],
            array_diff_assoc(
                $this->storage->getAll(),
                $this->initialValues,
            ),
            'storage is filed with values on different ways',
        );

        $this->tester->assertSame(
            [
                'A' => 'a',
                'N' => false,
                'D' => 'd',
            ],
            $this->storage->getMultiple(['A', 'N', 'D']),
            'getMultiple() with a missing name',
        );

        $this->tester->assertSame('b', $this->storage['B']);
        $this->tester->assertFalse($this->storage['b']);

        $this->tester->assertFalse($this->storage->has('NOT_YET'));
        $this->storage->put('NOT_YET=value');
        $this->tester->assertTrue($this->storage->has('NOT_YET'));
        $this->storage->put('NOT_YET');
        $this->tester->assertFalse($this->storage->has('NOT_YET'));

        $this->storage->put('G=new1');
        $this->tester->assertSame('new1', $this->storage->get('G'));
        $this->storage->putAssoc('G', null);
        $this->tester->assertFalse($this->storage->has('G'));

        $this->storage->put('G=new2');
        $this->tester->assertSame('new2', $this->storage->get('G'));
        $this->tester->assertTrue(isset($this->storage['G']));
        $this->tester->assertArrayHasKey('G', $this->storage);
        unset($this->storage['G']);
        $this->tester->assertFalse($this->storage->has('G'));
        $this->tester->assertFalse(isset($this->storage['G']));
        $this->tester->assertArrayNotHasKey('G', $this->storage);
    }
}
