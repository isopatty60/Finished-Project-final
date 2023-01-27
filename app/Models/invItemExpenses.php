<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invItemExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'date', 'detail', 'price', 'detail_expenses_id', 'image_product', 'note'
    ];
}