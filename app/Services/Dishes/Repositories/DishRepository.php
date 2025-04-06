<?php

declare(strict_types=1);

namespace App\Services\Dishes\Repositories;

use App\Models\Dish;
use App\Services\Dishes\DTO\CreateDishDTO;

class DishRepository
{
    public function create(CreateDishDTO $dto): Dish
    {
        return Dish::create([
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'price' => $dto->getPrice(),
        ]);
    }
}
