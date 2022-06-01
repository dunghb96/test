<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payments extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'payments';

    protected $fillable = [
        'trading_id',
        'payment_status',
        'trading_data'
    ];
}
