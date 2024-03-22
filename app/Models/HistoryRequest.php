<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRequest extends Model
{
    use HasFactory;
    protected $table = "history_request";
    protected $fillable = [
        'request_id',
        'file',
        'description',
        'status',
    ];
}
