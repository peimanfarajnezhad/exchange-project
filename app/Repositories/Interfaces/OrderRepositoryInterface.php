<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\StoreExchangeOrder;

interface OrderRepositoryInterface
{
    public function store(StoreExchangeOrder $request);
}
