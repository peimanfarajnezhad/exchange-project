<?php

namespace App\Repositories\Interfaces;

use App\Models\Currency;

interface PriceRepositoryInterface
{
    public function all();

    public function getByCurency(Currency $currency);

    public function createMultiple(array $prices);
}
