<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invDetailsExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name', 'date', 'detail', 'Month_id', 'price', 'note'
    ];

    public function inv_months()
    {
        return $this->belongsTo(\App\Models\InvMonths::class);
    }
}