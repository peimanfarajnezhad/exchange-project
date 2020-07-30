<?php

namespace App\Repositories\Interfaces;

use App\Models\Currency;

interface PriceRepositoryInterface
{
    public function get($id);

    public function all();

    public function getLast();

    public function getByCurency(Currency $currency);

    public function createMultiple(array $prices);
}
