<?php

declare(strict_types=1);

namespace App\Services\Dishes;

use App\Models\Dish;
use App\Services\Dishes\DTO\CreateDishDTO;
use App\Services\Dishes\Repositories\DishRepository;

class DishesService
{
    public function __construct(
        private readonly DishRepository $dishRepository,
    ) {
    }

    public function create(CreateDishDTO $dto): Dish
    {
        return $this->dishRepository->create($dto);
    }
}
