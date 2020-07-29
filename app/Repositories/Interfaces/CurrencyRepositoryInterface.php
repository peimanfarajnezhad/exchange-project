<?php

namespace App\Repositories\Interfaces;

use App\Models\Currency;

interface CurrencyRepositoryInterface
{
    public function getByAbbrWithPrices(string $abbr);
}
