<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invMonthExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name', 'date', 'detail', 'Fiscal_year_id'
    ];

    public function invDetailsExpenses()
    {
        return $this->hasMany(\App\Models\invDetailsExpenses::class);
    }
}