<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function getByAbbr(string $abbr)
    {
        return Currency::query()->where('abbr', $abbr)->first();
    }

    public function getByAbbrWithPrices(string $abbr)
    {
        return Currency::query()->with('prices')->where('abbr', $abbr)->first();
    }
}
