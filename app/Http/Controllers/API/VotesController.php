<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function vote($entityId , $type , Request $request){
        $user_id = $request[0];
        $user = User::find($user_id);
        $entity = $this->getEntity($entityId);
        return $user->toggleVote($entity , $type);
    }

    public function getEntity($entityId){
        $video = Video::find($entityId);
        if ($video) return $video;

        $comment = Comment::find($entityId);
        if ($comment) return $comment;

        throw new ModelNotFoundException('Entity Not Found');
    }
}
