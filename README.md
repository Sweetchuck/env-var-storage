# Environment variable storage

[![CircleCI](https://circleci.com/gh/Sweetchuck/env-var-storage/tree/1.x.svg?style=svg)](https://circleci.com/gh/Sweetchuck/env-var-storage/?branch=1.x)
[![codecov](https://codecov.io/gh/Sweetchuck/env-var-storage/branch/1.x/graph/badge.svg?token=HSF16OGPyr)](https://app.codecov.io/gh/Sweetchuck/env-var-storage/branch/1.x)

This library provides a wrapper around the [\getenv()] and [\putenv()] functions.


## Interface

[EnvVarStorageInterface](./src/EnvVarStorageInterface.php)


## Implementation - real

[EnvVarStorage](./src/EnvVarStorage.php) uses the real [\getenv()] and [\putenv()] 
functions to get/set environment variables.


## Implementation - dummy

[ArrayStorage](./src/ArrayStorage.php) uses an \ArrayObject instance to store „environment” variables.
Use this one for testing purposes.


## Service definition

```yaml
services:
    env_var_storage:
        shared: true
        class: 'Sweetchuck\EnvVarStorage\EnvVarStorage'
```


## Usage

```php
<?php

use Sweetchuck\EnvVarStorage\EnvVarStorageInterface;

class Foo
{    
    protected EnvVarStorageInterface $envVarStorage;

    public function __construct(EnvVarStorageInterface $envVarStorage) {
        $this->envVarStorage = $envVarStorage;
    }
    
    public function doSomething(): string
    {
        return $this->envVarStorage->get('PATH');
    }
}
```


## Usage in tests

```php
<?php

class FooTest extends \PHPUnit\Framework\TestCase
{
    public function testDoSomething()
    {
        $envVarStorage = new \Sweetchuck\EnvVarStorage\ArrayStorage(new \ArrayObject(['PATH' => '/a:/b']))
        $foo = new \Foo($envVarStorage);
        $this->assertSame('/a:/b', $foo->doSomething());
    }
}
```

[\getenv()]: https://www.php.net/manual/en/function.getenv.php
[\putenv()]: https://www.php.net/manual/en/function.putenv.php
