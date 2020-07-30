<?php

namespace App\Repositories;

use App\Http\Requests\StoreExchangeOrder;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PriceRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    private $priceRepository = null;

    public function __construct(PriceRepositoryInterface $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    public function store(StoreExchangeOrder $request)
    {
        $validated = $request->validated();

        $from = $this->priceRepository->get($validated['from']);
        $to = $this->priceRepository->get($validated['to']);

        $order = Order::create([
            'user_email' => $validated['email'],
            'from_price' => $from->id,
            'to_price' => $to->id,
            'exchange_total_value' => $validated['amount']
        ]);

        return $order;
    }
}
