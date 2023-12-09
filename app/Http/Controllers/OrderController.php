<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $order, $menu, $orderdetail;

    public function __construct()
    {
        $this->order = new Order();
        $this->menu = new Menu();
        $this->orderdetail = new OrderDetail();
    }


    public function showOrder(Request $request)
    {
        $menus = $this->menu->getAllMenu();
        if ($request->user() !== null) {
            $orders = $this->order->getOrderByUserId($request->user()->id);
            return view('frontend.order', compact('menus', 'orders'));
        }
        return view('frontend.order', compact('menus',));
    }

    public function addOrder(Request $request)
    {
        $cart = session()->get('cart');
        $user = Auth::user();
        if (empty($user)) {
            return response()->json(['status' => 400, 'route' => route('login')]);
        } elseif (empty($cart)) {
            return response()->json(['status' => 404, 'msg' => "Shopping cart is empty!"]);
        } else {
            return $this->order->addOrder($request);
        }
    }

    public function changeStatus(Request $request)
    {
        $result = $this->order->changeStatusOrder($request->id);
        if ($result === true) {
            return redirect()->back()->with('success', 'Goods received successfully');
        }
        return redirect()->back()->with('error', 'Status cannot be changed. Please contact 0352029544 for resolution');

    }

    public function showOrderDetail(Request $request)
    {
        $orderDetail = $this->orderdetail->getOrderByOrderId($request->id);
        $output = view('frontend.order.modal-order', compact('orderDetail'))->render();
        return response()->json(['html' => $output]);
    }

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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->order->deleteOrder($request->id);
        if ($result) {
            return redirect()->back()->with('success', 'Cancel order successfully!');
        } else {
            return redirect()->back()->with('error', 'Order cancellation failed!');
        }
    }
}
