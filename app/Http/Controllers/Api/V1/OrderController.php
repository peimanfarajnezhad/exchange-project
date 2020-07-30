<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExchangeOrder;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderController extends Controller
{
    private $orderRepository = null;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
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
        $order = $this->orderRepository->store($request);

        return $this->echoSuccessJson(['order_id' => $order->id]);
    }
}
