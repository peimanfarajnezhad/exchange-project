<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'abbr'];

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function fromOrders() {
        return $this->hasManyThrough(Order::class, Price::class, 'currency_id', 'from_price');
    }

    public function toOrders() {
        return $this->hasManyThrough(Order::class, Price::class, 'currency_id', 'to_price');
    }
}
