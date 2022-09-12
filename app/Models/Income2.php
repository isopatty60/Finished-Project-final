<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name','date', 'detail', 'id_income02_lists' , 'price' ,'note'
    ];
}
