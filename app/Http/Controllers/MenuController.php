<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function index()
    {
        $menus = $this->menu->getAllMenu();
        return view('frontend.master', compact('menus'));
    }

    public function masterIndex()
    {
        $menus = $this->menu->getAllMenu();
        return view('frontend.masterindex', compact('menus'));
    }

    public function create()
    {
        return view('backend.menu.addmenu');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        $data = [

            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->menu->addMenu($data);
        return redirect()->route('listmenu')->with('success', 'Thêm menu sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $menu = $this->menu->getAllMenu();

        return view('backend.menu.listmenu')->with('menu', $menu);
    }

    public function edit($id = 0, Request $request)
    {
        if (!empty($id)) {
            $menuDetail = $this->menu->getDetail($id);
            if (!empty($menuDetail[0])) {
                $request->session()->put('id', $id);
                return view('backend.menu.editmenu', [
                    'menuDetail' => $menuDetail,

                ]);
            }
        }
    }

    public function update(MenuRequest $request)
    {
        $id = session('id');
        $dataUpdate = [

            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'updated_at' => date('Y-m-d H:i:s')

        ];

        $this->menu->updateMenu($dataUpdate, $id);
        return redirect()->route('listmenu')->with('success', 'Cập nhật menu thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = $this->menu->deleteMenu($id);
        if ($delete) {
            $success = "Xóa menu thành công ";
        } else {
            $error = "Xóa menu thất bại";
        }
        return redirect()->route('listmenu')->with('success', 'Xóa menu thành công ');
    }

    public function getSearchMenu(Request $request)
    {
        $keyword = $request->input('search');
        if (empty($keyword)) {
            return redirect()->route('listmenu')->with('error', 'Bạn cần nhập menu cần tìm  !');
        } else {
            $search = Menu::where('name', 'like', '%' . $keyword . '%')
                ->orWhere('url', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listmenu')->with('error', 'menu bạn cần tìm không tồn tại !');
            } else {
                $menu = $search->paginate(5);
                return view('backend.menu.listmenu', ['menu' => $menu]);
            }
        }
    }
}
