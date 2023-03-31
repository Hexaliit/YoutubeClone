<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function store(Channel $channel , Request $request){
        $user = $request;
        return $channel->subscriptions()->create([
            'user_id' => $user->id
        ]);
    }
    public function destroy(Channel $channel , Subscription $subscription){
        $subscription->delete();
        return response()->json([]);
    }
}
