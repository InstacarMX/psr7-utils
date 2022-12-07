<?php

declare(strict_types=1);

namespace Instacar\Psr7Utils\Test\Models;

class DummyModel
{
    public string $firstName;

    public string $lastName;

    public int $age;

    public function __construct(string $firstName, string $lastName, int $age)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
    }
}
