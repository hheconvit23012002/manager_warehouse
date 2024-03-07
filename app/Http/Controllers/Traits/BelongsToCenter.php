<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

trait BelongsToCenter
{
    public function scopeBeLongsToCenter($query, $centerId)
    {
        return $query->where("center_id", $centerId);
    }
}

