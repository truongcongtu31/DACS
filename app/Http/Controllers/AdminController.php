<?php

namespace App\Http\Controllers;

use App\Models\FeedBack;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    private $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    //
    public function index()
    {
        $topBuyer = $this->order->getTopBuyer();
        $data = [
            'orders' => Order::count(),
            'products' => Product::count(),
            'users' => User::count(),
            'feedbacks' => Feedback::count(),
            'total' => $this->order->getTotalOrder()
        ];
        $allMonths = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];

        //Chart Month
        $totalByMonths = $this->order->getTotalByMonth();
        $tempArray = array_fill_keys($allMonths, 0);

        foreach ($totalByMonths as $item) {
            $tempArray[$item->month] = $item->total;
        }
        $totalByMonth = array_values($tempArray);

        //Chart Year
        $years = [];
        $totalByYear = [];
        $totalByYears = $this->order->getTotalByYear();
        //dd($totalByMonths, $totalByYears);
        foreach ($totalByYears as $item) {
            $years[] = $item->year;
            $totalByYear[] = $item->total;
        }
        return view('backend.index', compact('data', 'allMonths', 'totalByMonth', 'years', 'totalByYear', 'topBuyer'));
    }
}
