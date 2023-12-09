<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartController extends Controller
{
    private $cart, $product;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->product = new Product();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addToCart(Request $request, $id)
    {
        //dd($request->quantity);
        $product = $this->product->getProductDetails($id);
        $cart = session()->get('cart');
        //dd($cart[$id]['quantity'] + $request->quantity);
        if (isset($cart[$id])) {
            $num = count($cart);
            if (($cart[$id]['quantity'] + $request->quantity) <= $product->quantity && $request->quantity >= 1) {
                $cart[$id]['quantity'] += $request->input('quantity');
            } else {
                return response()->json(['status' => 400, 'num' => $num],);
            }
        } else {
            if ($request->quantity <= $product->quantity && $request->quantity >= 1) {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->input('quantity'),
                    'image' => $product->image
                ];
            } else {
                return response()->json(['status' => 400]);
            }
        }
        session()->put('cart', $cart);
        $num = count($cart);
        return response()->json(['status' => 200, 'num' => $num]);
    }

    public function getModalCart()
    {
        $cart = session()->get('cart');
        $total = $this->cart->getToTal();
        $output = view('frontend.products.modal-cart', compact('cart', 'total'))->render();
        return response()->json(['html' => $output]);
    }

    public function getCart()
    {
        $cart = session()->get('cart');
        $total = $this->cart->getToTal();
        return view('frontend.cart', compact('cart', 'total'));
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        if (empty($cart)) {
            return response()->json(['status' => 0]);
        } else {
            $data = json_decode($request->data);
            $num = count($cart);
            foreach ($data as $value) {
                if ($value->quantity < 1) {
                    $total = $this->cart->getToTal();
                    $output = view('frontend.assets.main-cart', compact('cart', 'total'))->render();
                    return response()->json(['status' => 400, 'html' => $output, 'num' => $num]);
                } else {
                    $product = $this->product->getProductDetails($value->id);
                    if ($value->quantity <= $product->quantity) {
                        $cart[$value->id]['quantity'] = $value->quantity;
                        session()->put('cart', $cart);
                    } else {
                        $total = $this->cart->getToTal();
                        $output = view('frontend.assets.main-cart', compact('cart', 'total'))->render();
                        return response()->json(['status' => 400, 'html' => $output]);
                    }
                }
            }
            $cart = session()->get('cart');
            $num = count($cart);
            $total = $this->cart->getToTal();
            $output = view('frontend.assets.main-cart', compact('cart', 'total'))->render();

            return response()->json(['status' => 200, 'html' => $output, 'num' => $num]);
        }
    }

    public function deleteCart(Request $request)
    {
        $cart = session()->get('cart');
        $num = count($cart);
        if (isset($cart)) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            $cart = session()->get('cart');
            $num = count($cart);
            $total = $this->cart->getToTal();
            $output = view('frontend.assets.main-cart', compact('cart', 'total'))->render();
            return response()->json(['status' => 200, 'html' => $output, 'num' => $num]);
        } else {
            $total = $this->cart->getToTal();
            $output = view('frontend.assets.main-cart', compact('cart', 'total'))->render();
            return response()->json(['status' => 400, 'html' => $output, 'num' => $num]);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
