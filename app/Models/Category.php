<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getAllCategory()
    {
        return Category::all();
    }


    public function addCategory($data)
    {
        return DB::table('categories')->insert($data);
    }

    public function getCategory()
    {
        $category = Category::all();
        return $category;

    }

    public function getDetail($id)
    {
        return DB::table('categories')
            ->select("id", "name")
            ->where('id', '=', $id)
            ->get();
    }

    public function updateCategory($dataUpdate, $id)
    {
        $category = DB::table('categories')
            ->where('id', '=', $id)
            ->update($dataUpdate);

        return $category;

    }

    public function deleteCategory($id)
    {
        return DB::table('categories')
            ->where('id', '=', $id)
            ->delete();
    }


}
