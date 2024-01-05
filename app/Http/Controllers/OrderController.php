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
            return view('frontend.order.order', compact('menus', 'orders'));
        }
        return view('frontend.order.order', compact('menus',));
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

    public function showOrderDetail(Request $request)
    {
        $orderDetail = $this->orderdetail->getOrderByOrderId($request->id);
        $output = view('frontend.order.modal-order', compact('orderDetail'))->toHtml();
        return response()->json(['html' => $output]);
    }


    public function show()
    {
        $order = $this->order->getAllOrder();
        return view('backend.orders.listorder', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $order = $this->order->adminChangeStatusOrder($request->id);
        if ($order) {
            return redirect()->back()->with('success', 'Change status successfully');
        } else {
            return redirect()->back()->with('error', 'Change status failed');
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

    public function getSearchOrder(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listorder')->with('error', 'Please enter the keyword you want to search for!');
        } else {

            $search = Order::where(function ($query) use ($keyword) {
                $query->whereHas('user', function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                })
                    ->orWhere('address', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%')
                    ->orWhere('status', 'like', $keyword);
            });
            if ($search->count() == 0) {
                return redirect()->route('listorder')->with('error', 'The order information you are looking for does not exist!');
            } else {
                $order = $search->paginate(8);
                return view('backend.orders.listorder', ['order' => $order]);
            }
        }
    }
}
