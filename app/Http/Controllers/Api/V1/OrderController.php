<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExchangeOrder;
use App\Repositories\Interfaces\PriceRepositoryInterface;

class OrderController extends Controller
{
    private $priceRepository = null;

    public function __construct(PriceRepositoryInterface $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    public function get($id)
    {
        $order = Order::query()->with(['fromPrice.currency', 'toPrice.currency'])->find($id);

        if (!$order) {
            return $this->echoErrorJson(null, 404, 'یافت نشد');
        }

        return $this->echoSuccessJson($order);
    }

    public function create(StoreExchangeOrder $request)
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

        return $this->echoSuccessJson(['order_id' => $order->id]);
    }
}
