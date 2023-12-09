<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function carts()
    {
        return $this->belongsTo(Cart::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getProduct()
    {

        return Product::paginate(8);
    }

    public function getAllProduct()
    {
        $allProduct = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select("products.id", "products.name", "image", "image_detail_1", "image_detail_2", "image_detail_3", "description", "price", "quantity", "color", "category_id",)
            ->paginate(8);


        return $allProduct;
    }


    public function getProductByIdCategory($id)
    {
        return Product::where('category_id', $id)->paginate(4);
    }

    public
    function getLatestProduct()
    {
        return Product::orderBy('created_at', 'desc')->take(8)->get();
    }

    public
    function getProductDetails($idProduct)
    {
        return Product::find($idProduct);
    }

    public function getDetail($id)
    {
        return Product::find($id);
    }

    public function searchProduct(Request $request)
    {
        $product = Product::where('name', 'Like', '%' . $request->search . '%')
            ->orWhere('price', 'Like', '%' . $request->search . '%')
            ->paginate(8);
        return $product;


    }

    public function getProductByfilter(Request $request)
    {
        $filterField = $request->get('filterField');
        $filterDirection = $request->get('filterDirection');
        $start = $request->get('start') ?? 0;
        $end = $request->get('end') ?? 10000;
        $colors = $request->get('colors');
        $id = $request->get('id');
        $query = Product::where('price', '>=', $start)
            ->where('price', '<=', $end);
        if ($id) {
            $query = $query->where('category_id', $id);
        }
        if ($filterField) {
            $query = $query->orderBy($filterField, $filterDirection ?? 'asc');
        }
        if (!empty($colors)) {
            $query = $query->where('color', $colors);
        }
        return $query->paginate(8);
    }

    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'price' => 'required|numeric|between:0,999999.99',
            'quantity' => 'required|integer',
            'color' => 'required',
            'upload_product' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'upload_product1' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'upload_product2' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'upload_product3' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $product = new Product();
            $product->name = $request->input('name');
            if ($request->upload_product->isValid()) {
                try {
                    $name = $request->file('upload_product')->getClientOriginalName();
                    $filenameUpload = time() . '.' . $name;
                    $pathFile = 'images/products';
                    $request->file('upload_product')->move(public_path($pathFile), $filenameUpload);
                    $product->image = $pathFile . '/' . $filenameUpload;
                } catch (Exception $error) {

                }
            }
            if ($request->upload_product1->isValid()) {
                try {
                    $name = $request->file('upload_product1')->getClientOriginalName();
                    $filenameUpload = time() . '.' . $name;
                    $pathFile = 'images/products';
                    $request->file('upload_product1')->move(public_path($pathFile), $filenameUpload);
                    $product->image_detail_1 = $pathFile . '/' . $filenameUpload;
                } catch (Exception $error) {

                }
            }
            if ($request->upload_product2->isValid()) {
                try {
                    $name = $request->file('upload_product2')->getClientOriginalName();
                    $filenameUpload = time() . '.' . $name;
                    $pathFile = 'images/products';
                    $request->file('upload_product2')->move(public_path($pathFile), $filenameUpload);
                    $product->image_detail_2 = $pathFile . '/' . $filenameUpload;
                } catch (Exception $error) {

                }
            }
            if ($request->upload_product3->isValid()) {
                try {
                    $name = $request->file('upload_product3')->getClientOriginalName();
                    $filenameUpload = time() . '.' . $name;
                    $pathFile = 'images/products';
                    $request->file('upload_product3')->move(public_path($pathFile), $filenameUpload);
                    $product->image_detail_3 = $pathFile . '/' . $filenameUpload;
                } catch (Exception $error) {
                    dd("lõi");
                }
            }
            $product->description = (string)$request->input('description');
            $product->price = floatval($request->input('price'));
            $product->quantity = $request->input('quantity');
            $product->color = $request->input('color');
            $product->category_id = $request->input('category_id');
            $product->created_at = date('Y-m-d H:i:s');
            $result = $product->save();
            if ($result) {
                return redirect()->route('listproduct')->with('success', "Add product success!");
            }
        }
    }


    public function updateProduct($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'price' => 'required|numeric|between:0,999999.99',
            'quantity' => 'required|integer',
            'color' => 'required',
            'upload_product' => 'image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'upload_product1' => 'image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'upload_product2' => 'image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'upload_product3' => 'image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $product = Product::find($request->id);
            $product->name = $request->name;
            if ($request->upload_product !== null) {
                if ($request->upload_product->isValid()) {
                    try {
                        $name = $request->file('upload_product')->getClientOriginalName();
                        $filenameUpload = time() . '.' . $name;
                        $pathFile = 'images/products';
                        $request->file('upload_product')->move(public_path($pathFile), $filenameUpload);
                        $product->image = $pathFile . '/' . $filenameUpload;
                    } catch (Exception $error) {

                    }
                }
            } else {
                $product->image = $request->product;
            }
            if ($request->upload_product1 !== null) {
                if ($request->upload_product1->isValid()) {
                    try {
                        $name = $request->file('upload_product1')->getClientOriginalName();
                        $filenameUpload = time() . '.' . $name;
                        $pathFile = 'images/products';
                        $request->file('upload_product1')->move(public_path($pathFile), $filenameUpload);
                        $product->image_detail_1 = $pathFile . '/' . $filenameUpload;
                    } catch (Exception $error) {

                    }
                }
            } else {
                $product->image_detail_1 = $request->product_detail_1;
            }
            if ($request->upload_product2 !== null) {
                if ($request->upload_product2->isValid()) {
                    try {
                        $name = $request->file('upload_product2')->getClientOriginalName();
                        $filenameUpload = time() . '.' . $name;
                        $pathFile = 'images/products';
                        $request->file('upload_product2')->move(public_path($pathFile), $filenameUpload);
                        $product->image_detail_2 = $pathFile . '/' . $filenameUpload;
                    } catch (Exception $error) {

                    }
                }
            } else {
                $product->image_detail_2 = $request->product_detail_2;
            }
            if ($request->upload_product3 !== null) {
                if ($request->upload_product3->isValid()) {
                    try {
                        $name = $request->file('upload_product3')->getClientOriginalName();
                        $filenameUpload = time() . '.' . $name;
                        $pathFile = 'images/products';
                        $request->file('upload_product3')->move(public_path($pathFile), $filenameUpload);
                        $product->image_detail_3 = $pathFile . '/' . $filenameUpload;
                    } catch (Exception $error) {

                    }
                }
            } else {
                $product->image_detail_3 = $request->product_detail_3;
            }
            $product->description = (string)$request->input('description');
            $product->price = $request->input('price');
            $product->quantity = $request->input('quantity');
            $product->color = $request->input('color');
            $product->category_id = $request->input('category_id');
            $product->updated_at = date('Y-m-d H:i:s');
            $result = $product->save();
            if ($result) {
                return redirect()->route('listproduct')->with('success', "Update product thành công!");
            } else {
                return redirect()->route('listproduct')->with('error', "Failed to update product!");
            }
        }
    }

    public function deleteProduct($id)
    {

        return DB::table('products')
            ->where('id', '=', $id)
            ->delete();
    }

    public function getProductByCategory($id)
    {
        return Product::where('category_id', $id)->paginate(8);
    }
}
