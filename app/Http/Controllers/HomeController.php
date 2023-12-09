<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Slide;

class HomeController extends Controller
{
    //
    private $slide, $banner, $product, $menus;

    public function __construct()
    {
        $this->slide = new Slide();
        $this->banner = new Banner();
        $this->product = new Product();
        $this->menus = new Menu();
    }

    public function index()
    {

    }

    public function showProductDetail($idProduct)
    {
        return $this->product->getProductDetails($idProduct);
    }
}
