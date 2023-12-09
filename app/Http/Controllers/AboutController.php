<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutRequest;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $about;

    public function __construct(About $about)
    {
        $this->about = $about;
    }

    public function create()
    {
        return view('backend.about.addabout');
    }

    public function store(Request $request)
    {
        return $this->about->addAbout($request);
    }

    public function edit(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $aboutDetail = $this->about->getDetail($id);
            if (!empty($aboutDetail[0])) {
                $request->session()->put('id', $id);
                return view('backend.about.editabout', [
                    'aboutDetail' => $aboutDetail,
                ]);
            }
        }
    }

    public function show()
    {
        $about = $this->about->getAllAbout();
        return view('backend.about.listabout', ['about' => $about]);
    }

    public function update(Request $request)
    {
        $id = session('id');
        return $this->about->updateAbout($request);
    }

    public function destroy($id)
    {
        $delete = $this->about->deleteAbout($id);
        if ($delete) {
            $success = "Xóa thông tin about thành công ";
        } else {
            $error = "Xóa thông tin about thất bại";
        }
        return redirect()->route('listabout')->with('success', 'Xóa thông tin about thành công ');
    }

    public function getSearchAbout(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listabout')->with('error', 'Vui lòng nhập từ khóa bạn tìm kiếm');
        } else {
            $search = About::where('title', 'like', '%' . $keyword . '%')
                ->orWhere('content', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listabout')->with('error', 'Thông tin about bạn cần tìm không tồn tại !');
            } else {
                $about = $search->get();
                return view('backend.about.listabout', ['about' => $about]);
            }
        }
    }
}
