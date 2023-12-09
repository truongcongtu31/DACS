<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

class FeedBack extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'feed_backs';
    private Order $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function getFeedBack(Request $request)
    {
        return FeedBack::where('product_id', $request->get('id'))
            ->orderBy('created_at', 'desc')
            ->paginate(4);
    }


    public function addFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'star' => ['required', 'integer'],
            'content' => ['required', 'string'],
            'product_id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $user = Auth::user();
        $orders = $user->orders;

        foreach ($orders as $order) {
            $orderDetails = $this->order->getOrderByOrderId($order->id);
            foreach ($orderDetails as $orderDetail) {
                // Assuming product_id is an integer, you can compare directly
                if (number_format($orderDetail->product_id) === number_format($request->product_id)) {
                    $feedback = new FeedBack();
                    $feedback->name = $request->input('name');
                    $feedback->email = $request->input('email');
                    $feedback->star = $request->input('star');
                    $feedback->content = $request->input('content');
                    $feedback->product_id = $request->input('product_id');
                    $feedback->user_id = Auth::user()->id;
                    $feedback->save();
                    return response()->json(['status' => 1, 'msg' => 'Add success']);
                }
            }
        }

        return response()->json(['status' => 400]);
    }
}
