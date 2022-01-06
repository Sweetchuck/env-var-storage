<?php

declare(strict_types = 1);

namespace Sweetchuck\EnvVarStorage;

class EnvVarStorage extends BaseStorage
{

    // region EnvVarStorageInterface
    /**
     * {@inheritdoc}
     */
    public function get(?string $name, bool $localOnly = false)
    {
        return $name === null ?
            getenv()
            : getenv($name, $localOnly);
    }

    public function getAll($localOnly = false): array
    {
        return $this->get(null, $localOnly);
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $assignment): bool
    {
        return putenv($assignment);
    }
    // endregion
}
