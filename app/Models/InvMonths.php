<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvMonths extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail', 'name', 'date', 'detail', 'Fiscal_year_id'
    ];

    public function invDetails()
    {
        return $this->hasMany(\App\Models\invDetails::class);
    }
}