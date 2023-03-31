<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\User;
/*use http\Client\Curl\User;*/
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ChannelTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * @test
     */
    public function update_channel(){
        // auth user
        $channel = Channel::first();
        /*$user_id = $channel->user_id;*/

        // make a request with file
        $file = File::create('channel_avatar.png',100);
        $this->postJson('/api/update_channel/',[
            'name' => 'admin',
            'image' => $file
        ]);
        //channel was updated and image was stored
    $this->assertStatus(200);
    }


    public function a_channel_can_be_updated(){
        $channel = Channel::first();
        $channelName = $channel->name;
        $channelId = $channel->id;
        $userId = $channel->user_id;

        $file = File::create('channel_avatar.jpeg',100);
        $response = $this->withoutExceptionHandling()->postJson('api/update_channel/'.$channelId , [
            'name' => $channelName.'  Was Updated ',
            'description' => 'Some Good  Description',
            'image' => $file,
        ]);
        /*$this->assertDatabaseHas('channels',['image' => 'channel_avatar.png']);*/
        $response->assertStatus(200);

    }

    /**
     * @test
     */

    public function channel_is_updateable(){
        $channel = Channel::first();
        $channelName = $channel->name;
        $channelId = $channel->id;
        $userId = $channel->user_id;

        $file = File::create('avatar.jpeg',100);
        $response = $this->withoutExceptionHandling()->postJson('api/update_channel/'.$channelId , [
            'name' => $channelName.'  Was Updated ',
            'description' => 'Some Good  Description',
            'image' => $file,
        ]);
        /*$this->assertDatabaseHas('channels',['image' => 'channel_avatar.png']);*/
        $response->assertStatus(200);

    }




}
