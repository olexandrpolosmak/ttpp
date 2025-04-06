<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\OrderCart\Entities\OrderCart;
use App\Services\OrderCart\Entities\OrderCartDish;
use App\Services\OrderCart\Entities\OrderCartPackage;
use Tests\TestCase;

class OrderCartTest extends TestCase
{
    public function testEmptyOrderCart(): void
    {
        $orderCart = OrderCart::empty();
        $this->assertInstanceOf(OrderCart::class, $orderCart);
        $this->assertCount(0, $orderCart->getDishes());
        $this->assertNull($orderCart->getOrderPackage());
    }

    public function testAddDish(): void
    {
        $orderCart = OrderCart::empty();
        $dish = new OrderCartDish(1, 'Dish 1', 10.0, 1);
        $orderCart->addDish($dish);
        $this->assertCount(1, $orderCart->getDishes());
    }

    public function testRemoveDish(): void
    {
        $orderCart = OrderCart::empty();
        $dish = new OrderCartDish(1, 'Dish 1', 10.0, 1);
        $orderCart->addDish($dish);
        $orderCart->removeDish(1);
        $this->assertCount(0, $orderCart->getDishes());
    }

    public function testIncrementDish(): void
    {
        $orderCart = OrderCart::empty();
        $dish = new OrderCartDish(1, 'Dish 1', 10.0, 1);
        $orderCart->addDish($dish);
        $orderCart->incrementDish(1);
        $this->assertEquals(2, $orderCart->getDishes()[0]->getCount());
    }

    public function testGetTotal(): void
    {
        $orderCart = OrderCart::empty();
        $dish = new OrderCartDish(1, 'Dish 1', 10.0, 1);
        $orderCart->addDish($dish);
        $this->assertEquals(10.0, $orderCart->getTotal());
    }

    public function testSetOrderPackage(): void
    {
        $orderCart = OrderCart::empty();
        $orderPackage = new OrderCartPackage(1, 'Package 1', 5.0);
        $orderCart->setOrderPackage($orderPackage);
        $this->assertEquals($orderPackage, $orderCart->getOrderPackage());
    }

    public function testGetDishes(): void
    {
        $orderCart = OrderCart::empty();
        $dish = new OrderCartDish(1, 'Dish 1', 10.0, 1);
        $orderCart->addDish($dish);
        $this->assertCount(1, $orderCart->getDishes());
    }

    public function testGetOrderPackageExpectsNullByDefault(): void
    {
        $orderCart = OrderCart::empty();
        $this->assertNull($orderCart->getOrderPackage());
    }

    public function testAddMultipleDishes(): void
    {
        $orderCart = OrderCart::empty();
        $dish1 = new OrderCartDish(1, 'Dish 1', 10.0, 1);
        $dish2 = new OrderCartDish(2, 'Dish 2', 15.0, 1);
        $orderCart->addDish($dish1);
        $orderCart->addDish($dish2);
        $this->assertCount(2, $orderCart->getDishes());
    }

    public function testGetTotalWithOrderPackage(): void
    {
        $orderCart = OrderCart::empty();
        $dish = new OrderCartDish(1, 'Dish 1', 10.0, 1);
        $orderCart->addDish($dish);
        $orderPackage = new OrderCartPackage(1, 'Package 1', 5.0);
        $orderCart->setOrderPackage($orderPackage);
        $this->assertEquals(15.0, $orderCart->getTotal());
    }
}
