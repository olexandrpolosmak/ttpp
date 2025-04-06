<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
*/
class Dish extends Model
{
    public $timestamps = false;

    protected $guarded = [];
}
