<?php

declare(strict_types = 1);

namespace Sweetchuck\EnvVarStorage\Tests\Unit;

use Sweetchuck\EnvVarStorage\EnvVarStorage;

/**
 * @covers \Sweetchuck\EnvVarStorage\EnvVarStorage<extended>
 */
class EnvVarStorageTest extends StorageTestBase
{
    protected function _before()
    {
        $this->storage = new EnvVarStorage();
        $this->initialValues = $this->storage->getAll();
    }
}
