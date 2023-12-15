<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\FeedBack;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $product, $category, $menu, $feedback, $color;

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->menu = new Menu();
        $this->feedback = new FeedBack();
        $this->color = new Color();
    }


    public function showProductDetail(Request $request)
    {
        $id = $request->get('id');
        $product = $this->product->getProductDetails($id);
        $relatedProducts = $this->product->getLatestProduct();
        $menus = $this->menu->getAllMenu();
        return view('frontend.product-details', compact('menus', 'product', 'relatedProducts'));

    }

    public function searchProduct(Request $request)
    {
        if ($request->ajax()) {
            $products = $this->product->searchProduct($request);
            $output = view('frontend.products.list', compact('products'))->render();
            return response()->json(['html' => $output, 'pagination' => $products->appends(request()->all())->links('frontend.pagination')->toHtml()]);
        }
    }

    public function getProductByFilter(Request $request)
    {
        $products = $this->product->getProductByFilter($request);
//                 $products = $this->product->getAllProduct();

        $menus = $this->menu->getAllMenu();
        $categories = $this->category->getAllCategory();
        $colors = $this->color->getColor();
        return view('frontend.shop', compact('products', 'menus', 'categories', 'colors'));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->getAllCategory();
        $colors = $this->color->getAllColor();
        return view('backend.product.addproduct', compact('categories', 'colors'));
    }

    public function store(Request $request)
    {
        return $this->product->addProduct($request);
    }


    public function show()
    {
        $product = $this->product->getAllProduct();
        return view('backend.product.listproduct', compact('product'));
    }


    public function edit(Request $request)
    {
        $productDetail = $this->product->getProductDetails($request->id);
        if (!empty($productDetail)) {
            $category = $this->category->getAllCategory();
            return view('backend.product.editproduct', [
                'productDetail' => $productDetail,
                'category' => $category,
                'colors' => $this->color->getAllColor()
            ]);
        } else {
            return redirect()->route('listproduct')->with('error', 'Product does not exist !');
        }
    }

    public function update(Request $request)
    {
        $id = session('id');
        return $this->product->updateProduct($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = $this->product->deleteProduct($id);
        if ($delete) {
            $success = "Product removed successfully !";
        } else {
            $error = "Delete product failed !";
        }
        return redirect()->route('listproduct')->with('success', 'Product removed successfully !');
    }

    public function getSearchProduct(Request $request)
    {
        $keyword = $request->input('search');
        if (empty($keyword)) {
            return redirect()->route('listproduct')->with('error', 'Please enter the keyword you are looking for !');
        } else {
            $search = Product::where('name', 'like', '%' . $keyword . '%')
                ->orWhere('price', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%')
                ->orWhere('quantity', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listproduct')->with('error', 'The product you are looking for does not exist !');
            } else {
                $products = $search->paginate(8)->withQueryString();
                return view('backend.product.listproduct', ['product' => $products]);
            }
        }
    }
}
