<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invDetailExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name', 'date', 'detail', 'month_expenses_id', 'price', 'note'
    ];

    public function inv_months()
    {
        return $this->belongsTo(\App\Models\invMonthExpenses::class);
    }
}