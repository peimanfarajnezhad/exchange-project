<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\Price;
use App\Repositories\Interfaces\PriceRepositoryInterface;

class PriceRepository implements PriceRepositoryInterface
{
    public function all() {
        return Price::all();
    }

    public function getByCurency(Currency $currency) {
        return Price::query()->where(['currency_id' => $currency->id])->first();
    }
}
