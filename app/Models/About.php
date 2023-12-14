<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'title', 'content', 'image'
    ];

    public function getAllAbout()
    {
        $about = About::paginate(5);
        return $about;
    }

     public function addAbout(Request $request)
        {
           $validator = Validator::make($request->all(), [
                            'title' => 'required|string|max:55',
                            'content' => 'required',
                            'uploadabout' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif'
                        ]);
                        if ($validator->fails()) {
                            return redirect()->back()->withErrors($validator);
                        } else {
                            $about = new About();
                            $about->title = $request->input('title');
                            $about->content = $request->input('content');
                            if ($request->hasFile('uploadabout')) {
                                $file = $request->file('uploadabout');
                                $extension = $file->getClientOriginalExtension();
                                $filename = time() . '.' . $extension;
                                $path = 'uploads/about';
                                $file->move(public_path($path), $filename);
                                $about->image = $path . '/' . $filename;
                            }
                            $result = $about->save();
                            if ($result) {
                                return redirect()->route('listabout')->with('success', "Add about success!");
                            }
                        }
        }


    public function getDetail($id)
       {
           return About::find($id);
       }


    public function updateAbout($request)
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:55',
                'content' => 'required',
                'uploadabout' => 'image|max:2048|mimes:jpeg,png,jpg,gif'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {
                $about = About::find($request->id);
                $about->title = $request->title;
                $about->content = $request->input('content');
                if ($request->file('uploadabout') !== null) {
                    if ($request->hasFile('uploadabout')) {
                        $file = $request->file('uploadabout');
                        $name = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $name;
                        $path = 'uploads/about';
                        $file->move(public_path($path), $filename);
                        $about->image = $path . '/' . $filename;
                    }
                } else {
                    $about->image = $request->about;
                }
                $result = $about->save();
                if ($result) {
                    return redirect()->route('listabout')->with('success', "Update to about Success!");
                } else {
                    return redirect()->route('listabout')->with('error', "Failed to update about!");
                }
            }
        }

    public function deleteAbout($id)
    {
        return DB::table('abouts')
            ->where('id', '=', $id)
            ->delete();
    }
}
