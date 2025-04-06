<?php

declare(strict_types=1);

namespace App\Services\OrderCart\Entities;

class OrderCart
{
    public function __construct(
        private OrderCartDishesList $dishes,
        private ?OrderCartPackage $orderPackage,
    ) {
    }

    public static function empty(): self
    {
        return new self(new OrderCartDishesList(), null);
    }

    public function addDish(OrderCartDish $dish): void
    {
        $this->dishes->addDish($dish);
    }

    public function removeDish(int $id): void
    {
        $this->dishes->removeDish($id);
    }

    public function incrementDish(int $dishId): void
    {
        $this->dishes->incrementDish($dishId);
    }

    public function getTotal(): float
    {
        $total = 0.0;

        foreach ($this->dishes as $dish) {
            $total += $dish->getPrice() * $dish->getCount();
        }

        if ($this->orderPackage) {
            $total += $this->orderPackage->getPrice();
        }

        return $total;
    }

    public function getDishes(): OrderCartDishesList
    {
        return $this->dishes;
    }

    public function getOrderPackage(): ?OrderCartPackage
    {
        return $this->orderPackage;
    }

    public function setOrderPackage(?OrderCartPackage $orderPackage): void
    {
        $this->orderPackage = $orderPackage;
    }

}
