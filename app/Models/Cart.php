<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getToTal()
    {
        $total = 0;
        $cart = session()->get('cart');
        if (isset($cart)) {
            foreach ($cart as $key => $value) {
                $total += (number_format($value['price']) * $value['quantity']);
            }
            return $total;
        } else {
            return 0;
        }

    }
}
