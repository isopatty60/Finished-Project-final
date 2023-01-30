<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invReceiptLists extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'address', 'date', 'tel', 'postcode'
    ];
}
