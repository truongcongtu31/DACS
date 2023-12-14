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
            $success = "Successfully deleted slide information !";
        } else {
            $error = "Delete slide information failed !";
        }
        return redirect()->route('listslide')->with('success', 'Successfully deleted slide information !');
    }



}
