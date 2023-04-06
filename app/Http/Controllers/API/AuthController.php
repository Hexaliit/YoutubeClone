<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors(),
            ];
            return response()->json($response,400);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        /*$user = User::create($input);*/
        event(new Registered($user = User::create($input)));

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        /*event(new Registered($user = $this->create(collect($input))));*/

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User Registration Was Success',
        ];
        return response()->json($response,200);
    }
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email , 'password' => $request->password])) {
            //$user = Auth::user();

            $user = $request->user();
            $success['user'] = $user;
            $success['token'] = $user->createToken('MyApp')->plainTextToken;

            $response = [
                'success' => true,
                'data' => $success
            ];

            return response()->json($response,200);
        } else {
            $response = [
                'message' => 'Invalid Username or Password',
            ];
            return response()->json($response,401);
        }
    }
    public function get_user(){
        if (Auth::check()){
            $user = Auth::user();
            $channel =  $user->channel;
            return $user;
        }

    }
}
