<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsoCfdi extends Model
{
    use HasFactory;
    
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'uso_cfdi';
}
