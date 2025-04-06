<?php

declare(strict_types=1);

namespace App\Services\OrderCart\Entities;

use Illuminate\Support\Collection;

/**
 * @extends Collection<int, OrderCartDish>
 */
class OrderCartDishesList extends Collection
{
    public function addDish(OrderCartDish $dish): void
    {
        $existingDish = $this->findByDishId($dish->getDishId());
        if ($existingDish) {
            $existingDish->incrementCount();
        } else {
            $this->push($dish);
        }
    }

    public function removeDish(int $dishId): void
    {
        $dish = $this->findByDishId($dishId);
        if (!$dish) {
            return;
        }
        if ($dish->getCount() <= 1) {
            $this->forget($this->search($dish));
            return;
        }

        $dish->decrementCount();
    }

    public function findByDishId(int $dishId): ?OrderCartDish
    {
        return $this->first(fn(OrderCartDish $dish) => $dish->getDishId() === $dishId);
    }

    public function incrementDish(int $dishId): void
    {
        $dish = $this->findByDishId($dishId);
        if (!$dish) {
            return;
        }

        $dish->incrementCount();
    }
}
