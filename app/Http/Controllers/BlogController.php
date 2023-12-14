<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $slide, $banner, $product, $menu, $blog, $about, $contact, $category, $cart, $comment;

    public function __construct()
    {
        $this->menu = new Menu();
        $this->blog = new Blog();
        $this->product = new Product();
        $this->category = new Category();
        $this->cart = new Cart();
        $this->comment = new Comment();
    }

    public function getBlog()
    {
        $menus = $this->menu->getAllMenu();
        $blogs = $this->blog->getAllBlog();
        $categories = $this->category->getAllCategory();
        $products = $this->product->getLatestProduct();
        return view('frontend.blog', compact('menus', 'blogs', 'categories', 'products'));
    }

    public function getBlogDetail(Request $request)
    {
        $menus = $this->menu->getAllMenu();
        $blog = $this->blog->getBlogById($request->id);
        $comments = $this->comment->getCommentById($request->id);
        $categories = $this->category->getAllCategory();
        $products = $this->product->getLatestProduct();
        return view('frontend.blog-detail', compact('menus', 'blog', 'comments', 'categories', 'products'));
    }

//    public function showBlogDetail(Request $request, $id = 0)
//    {
//        if (!empty($id)) {
//            $blogDetail = $this->blog->getDetail($id);
//            if (!empty($blogDetail[0])) {
//                $request->session()->put('id', $id);
//                return view('frontend.blog-detail', [
//                    'blogDetail' => $blogDetail,
//                ]);
//            }
//        }
//    }

    public function create()
    {
        return view('backend.blog.addblog');
    }

    public function store(Request $request)
    {
        return $this->blog->addBlog($request);
    }

    public function edit(Request $request)
    {

        $blogDetail = $this->blog->getDetail($request->id);
        if (!empty($blogDetail)) {
            return view('backend.blog.editblog', [
                'blogDetail' => $blogDetail,
            ]);
        }

    }

    public function show()
    {
        $blog = $this->blog->getAllBlog();
        return view('backend.blog.listblog', ['blog' => $blog]);
    }

    public function update(Request $request)
    {
        return $this->blog->updateBlog($request);
    }

    public function destroy($id)
    {
        $delete = $this->blog->deleteBlog($id);
        if ($delete) {
            $success = "Successfully deleted blog information ! ";
        } else {
            $error = "Deleting blog information failed !";
        }
        return redirect()->route('listblog')->with('success', 'Successfully deleted blog information !');
    }

    public function getSearchBlog(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listblog')->with('error', 'Please enter the keyword you are looking for !');
        } else {
            $search = Blog::where('title', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listblog')->with('error', 'The blog information you are looking for does not exist!!');
            } else {
                $blog = $search->paginate(3);
                return view('backend.blog.listblog', ['blog' => $blog]);
            }
        }
    }
}
