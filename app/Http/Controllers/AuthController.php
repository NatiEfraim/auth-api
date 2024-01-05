<?php


namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use phpseclib3\Crypt\Hash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle user login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response(['error' => $validator->errors()], 400);
            }

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response(['error' => 'Unauthorized'], 401);
            }

            $user = $request->user();
            $token = $user->createToken("api-token")->accessToken;

            return response([
                "msg:" => "Login successfully",
                'user' => $user,
                'token' => $token,
            ], 200);
        } catch (\Exception $exception) {
            return response(['msg' => $exception->getMessage()], 400);
        }
    }

    ///////////function for register user
    public function register(RegisterRequest $request)
    {
        try {
            /////save the user in the database
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);
            ///carete token
            $token = $user->createToken("api-token")->accessToken;

            return response([
                "msg:" => "Register successfully",
                'user' => $user,
                'token' => $token,
            ], 200);
        } catch (\Exception $exception) {
            return response(['msg' => $exception->getMessage()], 400);
        }
    }
}
