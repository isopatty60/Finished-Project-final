<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invMonthExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name', 'date', 'detail', 'fiscal_year_id_expenses'
    ];

    public function invDetailsExpenses()
    {
        return $this->hasMany(\App\Models\invDetailsExpenses::class);
    }
}