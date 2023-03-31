<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Channels\UpdateChannelRequest;
use App\Models\Channel;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ChannelsController extends Controller
{
    public function show($id)
    {
        $channel = Channel::find($id);
        $videos = $channel->videos;
        $subscriptions = $channel->subscriptions;

        //$channel->image = Storage::disk('public_uploads')->url($channel->image);
        return response()->json([
            'channel' => $channel ,
            'videos' => $videos
        ],200);
    }

    public function update_channel(Request $request, $id)
    {
        $channel = Channel::find($id);
        if ($channel->user_id == $request->user_id){
            // check that only channel owner can update own channel information
            // another way to update
            /*        $channel->update([
                        'name' => $request->name ,
                        'description' => $request->description ,
                    ]);*/
            $channel->name = $request->name;
            $channel->description = $request->description;
            if ($request->hasFile('image')) {
                $fileName = time() . "." . $request->image->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('',  $request->image, $fileName);
                //$request->file('image')->storeAs('/img/upload' , $fileName , 'public_uploads');
                $channel->image = $fileName;
            }
            if ($channel->save()) {
                return response()->json([
                    'success' => 'Channel Updated Successfuly'
                ]);
            } else {
                return response()->json([
                    'error' => 'Channel Updating fails'
                ]);
            }
        } else {
            return response()->json([
                'error' => 'Unauthorized Request '
            ] , 401 );
        }

    }
}
