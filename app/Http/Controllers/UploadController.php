<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    //slide
    public function cUploadSlide(Request $request)
    {
        $url = $this->uploadSlide($request);
        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function uploadSlide(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();
                $pathFile = 'images/slides';
                $request->file('file')->storeAs('public/' . $pathFile, $name);
                return '/storage/' . $pathFile . '/' . $name;
            } catch (Exception $error) {
                return false;
            }
        }
    }

    //products

    public function cUploadProduct(Request $request)
    {
        $url = $this->uploadProduct($request);
        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function uploadProduct(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();
                //dd($name);
                $pathFile = 'images/products';
                $request->file('file')->move(public_path($pathFile), $name);
                return public_path($pathFile) . '/' . $name;
            } catch (Exception $error) {
                return false;
            }
        }
    }

    //about

    public function cUploadAbout(Request $request)
    {
        $url = $this->uploadAbout($request);
        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function uploadAbout(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();
                $pathFile = 'images/abouts';
                $request->file('file')->storeAs('public/' . $pathFile, $name);
                return '/storage/' . $pathFile . '/' . $name;
            } catch (Exception $error) {
                return false;
            }
        }
    }

    //banner

    public function cUploadBanner(Request $request)
    {
        $url = $this->uploadBanner($request);
        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function uploadBanner(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();
                $pathFile = 'images/banners';
                $request->file('file')->storeAs('public/' . $pathFile, $name);
                return '/storage/' . $pathFile . '/' . $name;
            } catch (Exception $error) {
                return false;
            }
        }
    }

    //blog

    public function cUploadBlog(Request $request)
    {
        $url = $this->uploadBlog($request);
        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function uploadBlog(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();
                $pathFile = 'images/blogs';
                $request->file('file')->storeAs('public/' . $pathFile, $name);
                return '/storage/' . $pathFile . '/' . $name;
            } catch (Exception $error) {
                return false;
            }
        }
    }
}
