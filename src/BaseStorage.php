<?php

declare(strict_types = 1);

namespace Sweetchuck\EnvVarStorage;

/**
 * @todo Validate $name.
 * @todo Validate $value.
 */
abstract class BaseStorage implements EnvVarStorageInterface
{
    // region ArrayAccess
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->putAssoc($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->put($offset);
    }
    // endregion

    // region Countable
    public function count()
    {
        return count($this->getAll());
    }
    // endregion

    // region EnvVarStorageInterface
    public function getMultiple(iterable $names, bool $localOnly = false): array
    {
        $vars = [];
        foreach ($names as $name) {
            $vars[$name] = $this->get($name, $localOnly);
        }

        return $vars;
    }

    public function putAssoc(string $name, ?string $value): bool
    {
        return $value === null ?
            $this->put($name)
            : $this->put("$name=$value");
    }

    /**
     * @return bool[]
     */
    public function putMultipleAssignment(iterable $assignments): array
    {
        $return = [];
        foreach ($assignments as $assignment) {
            $return[$assignment] = $this->put($assignment);
        }

        return $return;
    }

    /**
     * @return bool[
     */
    public function putMultipleAssoc(iterable $nameValuePairs): array
    {
        $return = [];
        foreach ($nameValuePairs as $name => $value) {
            $return[$name] = $this->putAssoc($name, $value);
        }

        return $return;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->getAll());
    }
    // endregion
}
