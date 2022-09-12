<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name','date', 'detail','price', 'id_income03_lists', 'image_product','note'
    ];
}
