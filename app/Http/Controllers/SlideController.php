<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    protected $slide;

    public function __construct(Slide $slide)
    {
        $this->slide = $slide;
    }

    public function create()
    {
        return view('backend.slide.addslide');
    }

    public function store(Request $request)
    {
        return $this->slide->addSlide($request);
    }

    public function edit(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $slideDetail = $this->slide->getDetail($id);
            if (!empty($slideDetail[0])) {
                $request->session()->put('id', $id);
                return view('backend.slide.editslide', [
                    'slideDetail' => $slideDetail,
                ]);
            }
        }
    }

    public function show()
    {
        $slide = $this->slide->getAllSlide();
        return view('backend.slide.listslide', ['slide' => $slide]);
    }

    public function update(Request $request)
    {
        return $this->slide->updateSlide($request);
    }

    public function destroy($id)
    {
        $delete = $this->slide->deleteSlide($id);
        if ($delete) {
            $success = "Xóa thông tin slide thành công ";
        } else {
            $error = "Xóa thông tin slide thất bại";
        }
        return redirect()->route('listslide')->with('success', 'Xóa thông tin slide thành công ');
    }

    public function getSearchSlide(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listslide')->with('error', 'Vui lòng nhập từ khóa bạn tìm kiếm');
        } else {
            $search = Slide::where('image', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listslide')->with('error', 'Thông tin slide bạn cần tìm không tồn tại !');
            } else {
                $slide = $search->paginate(5);
                return view('backend.slide.listslide', ['slide' => $slide]);
            }
        }
    }

}
