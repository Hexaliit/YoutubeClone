<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\Videos\ConvertFormatStreaming;
use App\Jobs\Videos\CreateVideoThumbnail;
use App\Models\Channel;
use Illuminate\Http\Request;

class UploadVideosController extends Controller
{
    public function index(Channel $channel){
        return response()->json([
            'channel' => $channel
        ],200);
    }
    public function store(Channel $channel){
        // why do we use route model binding?
        // because if channel did not found, simply returns 404 not found page
        $video = $channel->videos()->create([
            'title' => \request()->title,
            'path' => \request()->video->store("channels/{$channel->id}"),
        ]);

        $this->dispatch(new CreateVideoThumbnail($video));

        $this->dispatch(new ConvertFormatStreaming($video));
        return $video;
    }
}
