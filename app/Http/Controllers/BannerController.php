<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller

{
    protected $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    public function create()
    {
        return view('backend.banner.addbanner');
    }

    public function store(Request $request)
    {
        return $this->banner->addBanner($request);
    }

    public function edit(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $bannerDetail = $this->banner->getDetail($id);
            if (!empty($bannerDetail[0])) {
                $request->session()->put('id', $id);
                return view('backend.banner.editbanner', [
                    'bannerDetail' => $bannerDetail,
                ]);
            }
        }
    }

    public function show()
    {
        $banner = $this->banner->getAllBanner();
        return view('backend.banner.listbanner', ['banner' => $banner]);
    }

    public function update(Request $request)
    {
        return $this->banner->updateBanner($request);
    }

    public function destroy($id)
    {
        $delete = $this->banner->deleteBanner($id);
        if ($delete) {
            $success = "Successfully deleted banner information ! ";
        } else {
            $error = "Deleting banner information failed !";
        }
        return redirect()->route('listbanner')->with('success', 'Successfully deleted banner information ! ');
    }

    public function getSearchBanner(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listbanner')->with('error', 'Please enter the keyword you are looking for !');
        } else {
            $search = Banner::where('name', 'like', '%' . $keyword . '%')
                ->orWhere('event', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listbanner')->with('error', 'The banner information you are looking for does not exist !');
            } else {
                $banner = $search->get();
                return view('backend.banner.listbanner', ['banner' => $banner]);
            }
        }
    }
}
