<?php

declare(strict_types = 1);

namespace Sweetchuck\EnvVarStorage\Tests\Unit;

use Sweetchuck\EnvVarStorage\ArrayStorage;

/**
 * @covers \Sweetchuck\EnvVarStorage\ArrayStorage<extended>
 */
class ArrayStorageTest extends StorageTestBase
{
    protected function _before()
    {
        $this->storage = new ArrayStorage();
    }
}
