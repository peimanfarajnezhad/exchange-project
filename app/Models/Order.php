<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_email', 'from_price', 'to_price', 'exchange_total_value'];

    public function fromPrice()
    {
        return $this->belongsTo(Price::class, 'from_price');
    }

    public function toPrice()
    {
        return $this->belongsTo(Price::class, 'to_price');
    }
}
