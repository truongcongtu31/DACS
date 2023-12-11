<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getOrderByOrderId($id)
    {
        $user = Auth::user();
        if (isset($user)) {
            return OrderDetail::with('products')->where('order_id', $id)->get();
        }
    }
}
