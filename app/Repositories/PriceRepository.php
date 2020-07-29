<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\Price;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use App\Repositories\Interfaces\PriceRepositoryInterface;

class PriceRepository implements PriceRepositoryInterface
{
    private $currencyRepository = null;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function all()
    {
        return Price::all();
    }

    public function getByCurency(Currency $currency)
    {
        return Price::query()->where(['currency_id' => $currency->id])->first();
    }

    public function createMultiple(array $prices)
    {
        $items = collect([]);
        collect($prices)->each(function ($item) use ($items) {
            $currency = $this->currencyRepository->getByAbbrWithPrices($item['abbr']);
            $item = $currency->prices()->create(['value' => $item['price']]);
            $items->push($item);
        });
        return $items;
    }
}
