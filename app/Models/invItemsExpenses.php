<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invItemsExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name', 'date', 'detail', 'price', 'detail_id', 'image_product', 'note'
    ];
}