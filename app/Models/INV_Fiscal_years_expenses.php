<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class INV_Fiscal_years_expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description',
    ];
}