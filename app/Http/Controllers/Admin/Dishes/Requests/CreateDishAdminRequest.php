<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Dishes\Requests;

use App\Services\Dishes\DTO\CreateDishDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateDishAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function getDTO(): CreateDishDTO
    {
        return new CreateDishDTO(
            name: $this->validated('name'),
            description: $this->validated('description'),
            price: $this->validated('price'),
        );
    }
}
