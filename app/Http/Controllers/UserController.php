<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $slide, $banner, $product, $menu, $blog, $about, $contact, $category, $cart, $comment;

    public function __construct()
    {
        $this->slide = new Slide();
        $this->banner = new Banner();
        $this->product = new Product();
        $this->menu = new Menu();
        $this->blog = new Blog();
        $this->about = new About();
        $this->contact = new Contact();
        $this->category = new Category();
        $this->cart = new Cart();
        $this->comment = new Comment();
    }

    public function index()
    {
        $slides = $this->slide->getAllSlide();
        $banners = $this->banner->getAllBanner();
        $latestProducts = $this->product->getLatestProduct();
        $menus = $this->menu->getAllMenu();
        return view('frontend.index', compact('slides', 'banners', 'latestProducts', 'menus'));
    }

    public function getShop(Request $request)
    {
        $id = $request->get('id');
        if (empty($id)) {
            $products = $this->product->getProduct();
        } else {
            $products = $this->product->getProductByIdCategory($id);
        }
        $menus = $this->menu->getAllMenu();
        $categories = $this->category->getAllCategory();
        return view('frontend.shop', compact('products', 'menus', 'categories'));
    }


    public function getBlog()
    {
        $menus = $this->menu->getAllMenu();
        $blogs = $this->blog->getAllBlog();
        $categories = $this->category->getAllCategory();
        return view('frontend.blog', compact('menus', 'blogs', 'categories'));
    }

    public function getBlogDetail(Request $request)
    {
        $menus = $this->menu->getAllMenu();
        $blog = $this->blog->getBlogById($request->id);
        $comments = $this->comment->getCommentById($request->id);
        $categories = $this->category->getAllCategory();
        return view('frontend.blog-detail', compact('menus', 'blog', 'comments', 'categories'));
    }

    public function getContact()
    {
        $menus = $this->menu->getAllMenu();
        return view('frontend.contact', compact('menus'));
    }

    public function getAbout()
    {
        $menus = $this->menu->getAllMenu();
        return view('frontend.about', compact('menus'));
    }

    public function getCart()
    {
        $cart = session()->get('cart');
        $total = $this->cart->getToTal();
        $menus = $this->menu->getAllMenu();
        return view('frontend.cart', compact('cart', 'total', 'menus'));
    }
}
