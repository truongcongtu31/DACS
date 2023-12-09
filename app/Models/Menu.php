<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getAllMenu()
    {
        return Menu::all();
    }

    public function addMenu($data)
    {
        $menu = DB::table('menus')->insert($data);
        return $menu;
    }

    public function getDetail($id)
    {
        $menuDetail = DB::table('menus')
            ->select("id", "name", "url")
            ->where('id', '=', $id)
            ->get();

        return $menuDetail;
    }

    public function updateMenu($dataUpdate, $id)
    {
        $menu = DB::table('menus')
            ->where('id', '=', $id)
            ->update($dataUpdate);

        return $menu;
    }

    public function deleteMenu($id)
    {
        return DB::table('menus')
            ->where('id', '=', $id)
            ->delete();
    }
}
