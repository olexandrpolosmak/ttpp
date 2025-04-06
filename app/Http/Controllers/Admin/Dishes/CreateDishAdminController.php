<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Dishes;

use App\Http\Controllers\Admin\Dishes\Requests\CreateDishAdminRequest;
use App\Services\Dishes\DishesService;
use Illuminate\Http\JsonResponse;

class CreateDishAdminController
{
    public function __construct(
        private readonly DishesService $dishesService,
    ) {
    }

    public function __invoke(CreateDishAdminRequest $request): JsonResponse
    {
        $dish = $this->dishesService->create($request->getDTO());

        return response()->json($dish->toArray());
    }

}
