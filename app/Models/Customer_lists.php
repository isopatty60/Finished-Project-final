<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_lists extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name','date', 'detail','price', 'id_customer_lists','note','address'
    ];
}