<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = "deposits";
    protected $primaryKey = "order_id";
    protected $keyType      = 'string';
    public $timestamps = false;
}