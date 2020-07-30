<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function echoSuccessJson($data, int $status = 200, string $message = 'عملیات موفقیت آمیز بود') {
        return response()->json([ 'success' => true, 'message' => $message, 'data' => $data ], $status);
    }

    protected function echoErrorJson($data, int $status, string $message = 'خطایی رخ داده') {
        return response()->json([ 'success' => false, 'message' => $message, 'data' => $data ], $status);
    }
}
