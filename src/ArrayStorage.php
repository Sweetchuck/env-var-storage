<?php

declare(strict_types = 1);

namespace Sweetchuck\EnvVarStorage;

class ArrayStorage extends BaseStorage
{

    protected \ArrayObject $storage;

    public function __construct(?\ArrayObject $storage = null)
    {
        $this->storage = $storage ?: new \ArrayObject();
    }

    // region EnvVarStorage
    /**
     * {@inheritdoc}
     */
    public function get(?string $name, bool $localOnly = false)
    {
        return $this->storage[$name] ?? false;
    }

    public function getAll($localOnly = false): array
    {
        return $this->storage->getArrayCopy();
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $assignment): bool
    {
        $parts = explode('=', $assignment, 2);
        if (count($parts) === 1) {
            unset($this->storage[$assignment]);

            return true;
        }

        $this->storage[$parts[0]] = $parts[1];

        return true;
    }
    // endregion
}
