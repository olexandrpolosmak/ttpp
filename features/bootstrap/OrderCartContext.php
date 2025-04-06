<?php

declare(strict_types=1);

use App\Services\OrderCart\Entities\OrderCart;
use App\Services\OrderCart\Entities\OrderCartDish;
use App\Services\OrderCart\Entities\OrderCartPackage;
use Behat\Behat\Context\Context;
use Illuminate\Testing\Assert;

class OrderCartContext implements Context
{
    private OrderCart $cart;
    private array $dishes = [];
    private array $packages = [];

    /** @BeforeScenario */
    public function beforeScenario(): void
    {
        $this->cart = OrderCart::empty();
    }

    /** @Given the cart is empty */
    public function theCartIsEmpty(): void
    {
        $this->cart = OrderCart::empty();
    }

    /** @Given a dish :name with id :id and price :price */
    public function aDishWithIdAndPrice(string $name, int $id, float $price): void
    {
        $this->dishes[$id] = new OrderCartDish($id, $name, price: $price);
    }

    /** @When I add the dish :id to the cart */
    public function iAddTheDishToTheCart(int $id): void
    {
        $this->cart->addDish($this->dishes[$id]);
    }

    /** @Then the cart should contain :count item(s) */
    public function theCartShouldContainItems(int $count): void
    {
        Assert::assertCount($count, $this->cart->getDishes());
    }

    /** @Then the quantity of :dishId should be :quantity */
    public function theQuantityShouldBe(int $dishId, int $count): void
    {
        $items = $this->cart->getDishes();
        Assert::assertEquals($count, $items->findByDishId($dishId)->getCount());
    }

    /** @Then the total should be :total */
    public function theTotalShouldBe(float $total): void
    {
        Assert::assertEquals($total, $this->cart->getTotal());
    }

    /** @Given the cart has a dish :dishId with price :price */
    public function theCartHasADishWithPrice(int $dishId, float $price): void
    {
        $this->dishes[$dishId] = new OrderCartDish($dishId, 'Dish', $price);
        $this->cart->addDish($this->dishes[$dishId]);
    }

    /** @When I remove the dish :dishId from the cart */
    public function iRemoveTheDishFromTheCart(int $dishId): void
    {
        $this->cart->removeDish($dishId);
    }

    /** @When I increment the dish :dishId */
    public function iIncrementTheDish(int $dishId): void
    {
        $this->cart->incrementDish($dishId);
    }

    /** @Given a package :name with id :id */
    public function aPackageWithId(string $name, int $id): void
    {
        $this->packages[$id] = new OrderCartPackage($id, $name, 10);
    }

    /** @When I assign the package :id to the cart */
    public function iAssignThePackageToTheCart(int $id): void
    {
        $this->cart->setOrderPackage($this->packages[$id]);
    }

    /** @Then the cart should have package :id */
    public function theCartShouldHavePackage(int $id): void
    {
        Assert::assertEquals($id, $this->cart->getOrderPackage()->getId());
    }

    /** @Given the cart has a package :id */
    public function theCartHasPackage(int $id): void
    {
        $this->packages[$id] = new OrderCartPackage($id, 'Kulyochek', 10);
        $this->cart->setOrderPackage($this->packages[$id]);
    }

    /** @When I assign no package */
    public function iAssignNoPackage(): void
    {
        $this->cart->setOrderPackage(null);
    }

    /** @Then the cart should have no package */
    public function theCartShouldHaveNoPackage(): void
    {
        Assert::assertNull($this->cart->getOrderPackage());
    }

    /** @When I remove the dish :dishId */
    public function iRemoveDish(int $dishId): void
    {
        $this->cart->removeDish($dishId);
    }

    /** @Then the cart should be empty */
    public function theCartShouldBeEmpty(): void
    {
        Assert::assertEmpty($this->cart->getDishes());
    }
}
