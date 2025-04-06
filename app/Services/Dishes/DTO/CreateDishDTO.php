<?php

declare(strict_types=1);

namespace App\Services\Dishes\DTO;

use Illuminate\Contracts\Support\Arrayable;

class CreateDishDTO implements Arrayable
{
    public function __construct(
        private readonly string $name,
        private readonly string $description,
        private readonly float $price,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
