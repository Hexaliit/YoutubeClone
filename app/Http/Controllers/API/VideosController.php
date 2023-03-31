<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function show(Video $video){
        if (\request()->wantsJson()){
            $videoDetail =  $video;
            $votes = $video->votes;
            $subscriptions = $video->channel->subscriptions;
            return response()->json([
                'video' => $videoDetail,
                'votes' => $votes
            ]);
        }
        dd(compact('video'));
    }

    public function updateViews(Video $video){
        $video->increment('views');
        return response()->json([]);
    }
    public function updateVideo(Request $request , Video $video){
        $video->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return response()->json([]);
    }
}
