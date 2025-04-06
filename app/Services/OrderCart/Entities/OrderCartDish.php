<?php

declare(strict_types=1);

namespace App\Services\OrderCart\Entities;

class OrderCartDish
{
    public function __construct(
        private int $dishId,
        private string $name,
        private float $price,
        private ?OrderCartPackage $orderPackage = null,
        private int $count = 1,
    ) {
    }

    public function incrementCount(): void
    {
        $this->count++;
    }

    public function decrementCount(): void
    {
        $this->count--;
    }

    public function getDishId(): int
    {
        return $this->dishId;
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

    public function getOrderPackage(): ?OrderCartPackage
    {
        return $this->orderPackage;
    }

}
