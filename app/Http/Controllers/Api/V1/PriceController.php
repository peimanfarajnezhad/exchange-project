<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PriceRepositoryInterface;

class PriceController extends Controller
{
    private $priceRepository = null;

    public function __construct(PriceRepositoryInterface $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    public function list()
    {
        return response()->json($this->priceRepository->all());
    }
}
