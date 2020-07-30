<?php

namespace App\Repositories\Interfaces;

interface CurrencyRepositoryInterface
{
    public function getByAbbr(string $abbr);

    public function getByAbbrWithPrices(string $abbr);
}
