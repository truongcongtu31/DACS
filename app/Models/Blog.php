<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\HigherOrderCollectionProxy;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @var HigherOrderCollectionProxy|mixed|string
     */


    public function getAllBlog()
    {
        return Blog::paginate(3);
    }

    public function getBlogById($id)
    {
        return Blog::find($id);
    }

    public function addBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:55',
            'description' => 'required|string|max:255',
            'content' => 'required|',
            'content1' => 'required',
            'uploadblog' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $blog = new Blog();
            $blog->title = $request->input('title');
            $blog->description = $request->input('description');
            $blog->content = $request->input('content');
            $blog->content1 = $request->input('content1');
            if ($request->hasFile('uploadblog')) {
                $file = $request->file('uploadblog');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/blog';
                $file->move(public_path($path), $filename);
                $blog->image = $path . '/' . $filename;
            }
            $result = $blog->save();
            if ($result) {
                return redirect()->route('listblog')->with('success', "Add blog success!");
            }
        }
    }

    public function getDetail($id)
    {
        return Blog::find($id);
    }

    public function updateBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:55',
            'description' => 'required|string|max:255',
            'content' => 'required',
            'content1' => 'required',
            'uploadblog' => 'image|max:2048|mimes:jpeg,png,jpg,gif'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $blog = Blog::find($request->id);
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->content = $request->input('content');
            $blog->content1 = $request->content1;
            if ($request->file('uploadblog') !== null) {
                if ($request->hasFile('uploadblog')) {
                    $file = $request->file('uploadblog');
                    $name = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $name;
                    $path = 'uploads/blog';
                    $file->move(public_path($path), $filename);
                    $blog->image = $path . '/' . $filename;
                }
            } else {
                $blog->image = $request->blog;
            }
            $result = $blog->save();
            if ($result) {
                return redirect()->route('listblog')->with('success', "Update to Blog Success!");
            } else {
                return redirect()->route('listblog')->with('error', "Failed to update blog!");
            }
        }
    }

    public function deleteBlog($id)
    {
        return Blog::find($id)
            ->delete();
    }


}
