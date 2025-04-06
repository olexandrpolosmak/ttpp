<?php

declare(strict_types=1);

namespace Feature\Http\Admin;

use Tests\TestCase;

class CreateDishAdminControllerTest extends TestCase
{
    public function testCreateDishWithValidData(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'name' => 'New Dish',
            'price' => 12.99,
            'description' => 'Delicious new dish',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'price', 'description']);
    }

    public function testCreateDishWithMissingName(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'price' => 12.99,
            'description' => 'Delicious new dish',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function testCreateDishWithInvalidPrice(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'name' => 'New Dish',
            'price' => 'invalid',
            'description' => 'Delicious new dish',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('price');
    }

    public function testCreateDishWithMissingDescription(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'name' => 'New Dish',
            'price' => 12.99,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('description');
    }

    public function testCreateDishWithLongDescription(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'name' => 'New Dish',
            'price' => 12.99,
            'description' => str_repeat('a', 1001),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('description');
    }

    public function testCreateDishWithNegativePrice(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'name' => 'New Dish',
            'price' => -5.99,
            'description' => 'Delicious new dish',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('price');
    }

    public function testCreateDishWithZeroPrice(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'name' => 'New Dish',
            'price' => 0.00,
            'description' => 'Delicious new dish',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'price', 'description']);
    }

    public function testCreateDishWithSpecialCharactersInName(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'name' => 'New Dish!@#',
            'price' => 12.99,
            'description' => 'Delicious new dish',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'price', 'description']);
    }

    public function testCreateDishWithEmptyDescription(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'name' => 'New Dish',
            'price' => 12.99,
            'description' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('description');
    }

    public function testCreateDishWithValidDataAndNoDescription(): void
    {
        $response = $this->postJson('/admin/dishes', [
            'name' => 'New Dish',
            'price' => 12.99,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('description');
    }
}
