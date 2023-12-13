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


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function getAllProduct()
    {
        return Product::with('color')->paginate(8);
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
        return Product::with('color')->where('id', $idProduct)->first();
    }

    public function getDetail($id)
    {
        return Product::find($id);
    }

    public function searchProduct(Request $request)
    {
        return Product::where('name', 'Like', '%' . $request->search . '%')
            ->orWhere('price', 'Like', '%' . $request->search . '%')
            ->orWhere('tag', 'Like', '%' . $request->search . '%')
            ->paginate(8);
    }

    public function getProductByFilter(Request $request)
    {
        $filterField = $request->get('filterField');
        $filterDirection = $request->get('filterDirection', 'asc'); // Set a default value for filterDirection
        $start = $request->get('start', 0);
        $end = $request->get('end', 100000);
        $colors = $request->get('colors');
        $id = $request->get('id');
        $query = Product::whereBetween('price', [$start, $end]);
        if ($id) {
            $query->where('category_id', $id);
        }
        if ($filterField) {
            $query->orderBy($filterField, $filterDirection);
        }
        if (!empty($colors)) {
            $query->where('color_id', $colors);
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
            'tag' => 'required',
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
            $product->color_id = $request->input('color');
            $product->tag = $request->input('tag');
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
            'tag' => 'required',
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
            $product->color_id = $request->input('color');
            $product->tag = $request->input('tag');
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
