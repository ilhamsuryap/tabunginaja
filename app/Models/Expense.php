<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'item_name',
        'price',
        'quantity',
        'total',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
