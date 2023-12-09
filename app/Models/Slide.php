<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Slide extends Model
{


    use HasFactory;


    public function getAllSlide()
    {
        return Slide::paginate(8);
    }

    public function addSlide(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uploadslide' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $slide = new Slide();
            if ($request->hasFile('uploadslide')) {
                $file = $request->file('uploadslide');
                $name = $file->getClientOriginalName();
                $fileName = time() . '.' . $name;
                $path = 'images/slides';
                $file->move(public_path($path), $fileName);
                $slide->image = $path . '/' . $fileName;
            }
            $result = $slide->save();
            if ($result) {
                return redirect()->route('listslide')->with('success', "Add slide success!");
            }
        }
    }

    public function getDetail($id)
    {
        return DB::table('slides')
            ->select('id', 'image')
            ->where('id', '=', $id)
            ->get();
    }

    public function updateSlide(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uploadslide' => 'image|max:2048|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $slide = Slide::find($request->id);
            if ($request->file('uploadslide') !== null) {
                if ($request->hasFile('uploadslide')) {
                    $file = $request->file('uploadslide');
                    $name = $file->getClientOriginalName();
                    $fileName = time() . '.' . $name;
                    $path = 'images/slides';
                    $file->move(public_path($path), $fileName);
                    $slide->image = $path . '/' . $fileName;
                }
            } else {
                $slide->image = $request->slide;
            }
            $result = $slide->save();
            if ($result) {
                return redirect()->route('listslide')->with('success', "Update slide thành công!");
            } else {
                return redirect()->route('listslide')->with('error', "Failed to update slide!");
            }
        }
    }

    public function deleteSlide($id)
    {
        return DB::table('slides')
            ->where('id', '=', $id)
            ->delete();
    }
}
