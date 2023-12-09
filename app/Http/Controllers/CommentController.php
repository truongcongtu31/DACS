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


}
