<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetController extends Controller
{
    public function resetpassword(ResetRequest $request)
    {
        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);
        $emailVerfy = DB::table("password_reset_tokens")->where("email", $email)->first(); ///get the first you find
        $pinCode = DB::table("password_reset_tokens")->where("token", $token)->first(); ///get the first you find
        if (!$emailVerfy) {
            response(["msg:" => "email not found"], 401);
        } else if (!$pinCode) {
            response(["msg:" => "token not found"], 401);
        }
        /////insert into user table
        DB::table("users")->where("email", $email)->update(["password" => $password]);
        ///delete the token and email from the  password_reset_tokens
        DB::table("password_reset_tokens")->where("email", $email)->delete();
        response(["msg:" => "password has been changed"], 200);
    }
}
