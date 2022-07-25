<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateProduct extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    public $table = 'estimates_products';
}
