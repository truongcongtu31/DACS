<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Models\Menu;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $about, $menu;

    public function __construct(About $about)
    {
        $this->about = $about;
        $this->menu = new Menu();
    }

    public function getAbout()
    {
        $abouts = $this->about->getAllAbout();
        $menus = $this->menu->getAllMenu();
        return view('frontend.about', compact('menus', 'abouts'));
    }

    public function create()
    {
        return view('backend.about.addabout');
    }

    public function store(Request $request)
    {
        return $this->about->addAbout($request);
    }

    public function edit(Request $request)
    {

        $aboutDetail = $this->about->getDetail($request->id);
        if (!empty($aboutDetail)) {
            return view('backend.about.editabout', [
                'aboutDetail' => $aboutDetail,
            ]);
        }

    }

    public function show()
    {
        $about = $this->about->getAllAbout();
        return view('backend.about.listabout', ['about' => $about]);
    }

    public function update(Request $request)
    {
        return $this->about->updateAbout($request);
    }

    public function destroy($id)
    {
        $delete = $this->about->deleteAbout($id);
        if ($delete) {
            $success = "Successfully deleted about information ! ";
        } else {
            $error = "Delete information about failure !";
        }
        return redirect()->route('listabout')->with('success', 'Successfully deleted about information ! ');
    }

    public function getSearchAbout(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listabout')->with('error', 'Please enter the keyword you are looking for !');
        } else {
            $search = About::where('title', 'like', '%' . $keyword . '%')
                ->orWhere('content', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listabout')->with('error', 'The information you are looking for does not exist !');
            } else {
                $about = $search->paginate(5);;
                return view('backend.about.listabout', ['about' => $about]);
            }
        }
    }
}
