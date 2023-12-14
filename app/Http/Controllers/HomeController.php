<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Slide;

class HomeController extends Controller
{
    //
    protected $slide, $banner, $product, $menu;

    public function __construct()
    {
        $this->slide = new Slide();
        $this->banner = new Banner();
        $this->product = new Product();
        $this->menu = new Menu();
    }

    public function index()
    {
        $slides = $this->slide->getAllSlide();
        $banners = $this->banner->getAllBanner();
        $latestProducts = $this->product->getLatestProduct();
        $menus = $this->menu->getAllMenu();
        return view('frontend.index', compact('slides', 'banners', 'latestProducts', 'menus'));
    }

    public function showProductDetail($idProduct)
    {
        return $this->product->getProductDetails($idProduct);
    }
}
