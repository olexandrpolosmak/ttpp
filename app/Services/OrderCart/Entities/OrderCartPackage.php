<?php

declare(strict_types=1);

namespace App\Services\OrderCart\Entities;

class OrderCartPackage
{
    public function __construct(
        private int $id,
        private string $name,
        private float $price,
        private int $count = 1,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
