<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table = "withdrawals";
    protected $primaryKey = "order_id";
    protected $keyType      = 'string';
    public $timestamps = false;
}