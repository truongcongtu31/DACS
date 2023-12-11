<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment;

    public function __construct()
    {
        $this->comment = new Comment();
    }

    public function addComment(Request $request)
    {
        return $this->comment->addComment($request);
    }

    public function showCommentAjax(Request $request)
    {
        $comments = $this->comment->getCommentById($request->id);
        $output = view('frontend.products.comment', compact('comments'))->render();
        return response()->json(['html' => $output]);
    }

    public function destroy($id)
    {
        $delete = $this->comment->deleteComment($id);
        if ($delete) {
            $success = "Xóa bình luận thành công ";
        } else {
            $error = "Xóa bình luận thất bại";
        }
        return redirect()->route('listcomment')->with('success', 'Xóa bình luận thành công ');
    }

    public function show()
    {
        $comment = $this->comment->getAllComment();
        return view('backend.comment.listcomment', compact('comment'));
    }

    public function getSearchComment(Request $request)
    {
        $keyword = $request->input('search');
        if (empty($keyword)) {
            return redirect()->route('listcomment')->with('error', 'Bạn cần nhập bình luận cần tìm  !');
        } else {
            $search = Comment::where('name', 'like', '%' . $keyword . '%');
            if ($search->count() == 0) {
                return redirect()->route('listcomment')->with('error', 'Bình luận bạn cần tìm không tồn tại !');
            } else {
                $comments = $search->paginate(5);
                return view('backend.comment.listcomment', ['comment' => $comments]);
            }
        }
    }
}
