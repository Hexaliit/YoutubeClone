<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Video $video){
        return $video->comments()->paginate(5);
    }
    public function show(Comment $comment){
        return $comment->replies()->paginate(10);
    }
    public function store(Request $request , Video $video){
        $user = User::find($request->user_id);
        return $user->comments()->create([
            'body' => $request->body,
            'video_id' => $video->id,
            'comment_id' => $request->comment_id
        ])->fresh();
        //for getting eager loading too we should use fresh method at the end
    }
}
