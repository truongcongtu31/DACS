<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $color;

    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('backend.color.addcolor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'color_code' => $request->input('color_code'),
            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->color->addColor($data);
        return redirect()->route('listcolor')->with('success', 'Thêm màu sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        $color = $this->color->getAllColor();

        return view('backend.color.listcolor', compact('color'));
    }

    public function edit($id = 0, Request $request)
    {
        if (!empty($id)) {
            $colorDetail = $this->color->getDetail($id);
            if (!empty($colorDetail[0])) {
                $request->session()->put('id', $id);
                return view('backend.color.editcolor', [
                    'colorDetail' => $colorDetail,

                ]);
            }
        }
    }

    public function update(ColorRequest $request)
    {
        $id = session('id');
        $dataUpdate = [
            'name' => $request->input('name'),
            'color_code' => $request->input('color_code'),
            'updated_at' => date('Y-m-d H:i:s')

        ];
        $this->color->updateColor($dataUpdate, $id);
        return redirect()->route('listcolor')->with('success', 'Cập nhật màu sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = $this->color->deleteColor($id);
        if ($delete) {
            $success = "Xóa màu sản phẩm thành công ";
        } else {
            $error = "Xóa màu sản phẩm thất bại";
        }
        return redirect()->route('listcolor')->with('success', 'Xóa màu sản phẩm thành công ');
    }

    public function getSearchColor(Request $request)
    {
        $keyword = $request->input('search');
        if (empty($keyword)) {
            return redirect()->route('listcolor')->with('error', 'Bạn cần nhập màu cần tìm  !');
        } else {
            $search = Color::where('name', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listcolor')->with('error', 'Màu sản phẩm bạn cần tìm không tồn tại !');
            } else {
                $color = $search->paginate(5);
                return view('backend.color.listcolor', ['color' => $color]);
            }
        }
    }
}
