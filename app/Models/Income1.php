<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name','date', 'detail', 'id_income01_lists'
    ];
}
