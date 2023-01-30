<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invReceiptDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'detail', 'date', 'price', 'amount', 'note', 'Receipt_lists_id'
    ];
}
