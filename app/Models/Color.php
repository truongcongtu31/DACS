<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Color extends Model
{
    protected $guarded = [];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getAllColor()
    {
        return Color::paginate(8);
    }


    public function addColor($data)
    {
        return DB::table('colors')->insert($data);
    }

    public function getColor()
    {
        $color = Color::all();
        return $color;

    }

    public function getDetail($id)
    {
        return DB::table('colors')
            ->select("id", "name", "color_code")
            ->where('id', '=', $id)
            ->get();
    }

    public function updateColor($dataUpdate, $id)
    {
        $category = DB::table('colors')
            ->where('id', '=', $id)
            ->update($dataUpdate);

        return $category;

    }

    public function deleteColor($id)
    {
        return DB::table('colors')
            ->where('id', '=', $id)
            ->delete();
    }

}
