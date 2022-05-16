<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_bill_id',
        'buyer_confirm', 
        'seller_confirm', 
    ];
}
