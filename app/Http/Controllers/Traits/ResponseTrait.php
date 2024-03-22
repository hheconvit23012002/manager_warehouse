<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function successResponse($data = [], $message = ''): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ]);
    }

    public function errorResponse($message = '', $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => [],
            'message' => $message,
        ], $status);
    }

    public function formatNumberHistory($number){
        switch ($number) {
            case $number < 10 : return "000".$number;
            case $number < 100 : return "00".$number;
            case $number < 1000 : return "0" . $number;
            default : return $number;
        }
    }
    public function formatNumberRequest($number){
        switch ($number) {
            case $number < 10 : return "00".$number;
            case $number < 100 : return "0".$number;
            default : return $number;
        }
    }
}

