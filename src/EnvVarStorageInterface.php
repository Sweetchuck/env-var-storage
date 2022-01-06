<?php

declare(strict_types = 1);

namespace Sweetchuck\EnvVarStorage;

interface EnvVarStorageInterface extends \ArrayAccess, \Countable
{
    /**
     * @return array|string|false
     *
     * @see \getenv()
     */
    public function get(?string $name, bool $localOnly = false);

    public function getMultiple(iterable $names, bool $localOnly = false): array;

    public function getAll($localOnly = false): array;

    /**
     * @see \putenv()
     */
    public function put(string $assignment): bool;

    public function putAssoc(string $name, string $value): bool;

    public function putMultipleAssignment(iterable $assignments): array;

    public function putMultipleAssoc(iterable $nameValuePairs): array;

    public function has(string $name): bool;
}
