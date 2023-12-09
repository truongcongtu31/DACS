<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function showBlogDetail(Request $request, $id = 0)
    {
        if (!empty($id)) {
            $blogDetail = $this->blog->getDetail($id);
            if (!empty($blogDetail[0])) {
                $request->session()->put('id', $id);
                return view('frontend.blog-detail', [
                    'blogDetail' => $blogDetail,
                ]);
            }
        }
    }

    public function create()
    {
        return view('backend.blog.addblog');
    }

    public function store(Request $request)
    {
        return $this->blog->addBlog($request);
    }

    public function edit(Request $request)
    {

        $blogDetail = $this->blog->getDetail($request->id);
        if (!empty($blogDetail)) {
            return view('backend.blog.editblog', [
                'blogDetail' => $blogDetail,
            ]);
        }

    }

    public function show()
    {
        $blog = $this->blog->getAllBlog();
        return view('backend.blog.listblog', ['blog' => $blog]);
    }

    public function update(Request $request)
    {
        return $this->blog->updateBlog($request);
    }

    public function destroy($id)
    {
        $delete = $this->blog->deleteBlog($id);
        if ($delete) {
            $success = "Xóa thông tin bài viết thành công ";
        } else {
            $error = "Xóa thông tin bài viết thất bại";
        }
        return redirect()->route('listblog')->with('success', 'Xóa thông tin bài viết thành công ');
    }

    public function getSearchBlog(Request $request)
    {
        $keyword = $request->input('search');
        if ($keyword == null) {
            return redirect()->route('listblog')->with('error', 'Vui lòng nhập từ khóa bạn tìm kiếm');
        } else {
            $search = Blog::where('title', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listblog')->with('error', 'Thông tin bài viết bạn cần tìm không tồn tại !');
            } else {
                $blog = $search->get();
                return view('backend.blog.listblog', ['blog' => $blog]);
            }
        }
    }
}
