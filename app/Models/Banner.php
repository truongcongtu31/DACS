<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'event', 'image'
    ];

    public function getAllBanner()
    {
        return Banner::all();
    }

    public function addBanner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'event' => 'required',
            'uploadbanner' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $banner = new Banner();
            if ($request->hasFile('uploadbanner')) {
                $file = $request->file('uploadbanner');
                $name = $file->getClientOriginalName();
                $fileName = time() . '.' . $name;
                $path = 'images/banners';
                $file->move(public_path($path), $fileName);
                $banner->image = $path . '/' . $fileName;
            }
            $banner->name = $request->input('name');
            $banner->event = $request->input('event');
            $result = $banner->save();
            if ($result) {
                return redirect()->route('listbanner')->with('success', "Add banner success!");
            }
        }
    }


    public function getDetail($id)
    {
        $bannerDetail = DB::table('banners')
            ->select('id', 'name', 'event', 'image')
            ->where('id', '=', $id)
            ->get();

        return $bannerDetail;
    }

    public function updateBanner($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'event' => 'required',
            'uploadbanner' => 'image|max:2048|mimes:jpeg,png,jpg,gif'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $banner = Banner::find($request->id);
            if ($request->file('uploadbanner') !== null) {
                if ($request->hasFile('uploadbanner')) {
                    $file = $request->file('uploadbanner');
                    $name = $file->getClientOriginalName();
                    $fileName = time() . '.' . $name;
                    $path = 'images/banners';
                    $file->move(public_path($path), $fileName);
                    $banner->image = $path . '/' . $fileName;
                }
            } else {
                $banner->image = $request->banner;
            }
            $banner->name = $request->input('name');
            $banner->event = $request->input('event');
            $result = $banner->save();
            if ($result) {
                return redirect()->route('listbanner')->with('success', "Add banner success!");
            }
        }
    }

    public function deleteBanner($id)
    {
        return DB::table('banners')
            ->where('id', '=', $id)
            ->delete();
    }
}
