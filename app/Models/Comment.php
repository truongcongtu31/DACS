<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function addComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => ['required', 'string'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email']
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $comment = new Comment();
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->content = $request->comment;
            $comment->blog_id = $request->id;
            $comment->save();
            $comments = $this->getCommentById($request->id);
            $output = view('frontend.products.comment', compact('comments'))->render();
            return response()->json(['status' => 1, 'html' => $output]);
        }
    }

    public function getCommentById($id)
    {
        return Comment::where('blog_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(4);
    }
}
