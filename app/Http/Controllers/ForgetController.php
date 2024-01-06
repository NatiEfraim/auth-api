<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetRequest;
use App\Mail\ForgetMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Http\Request;

class ForgetController extends Controller
{
    //
    public function forgetPassword(ForgetRequest $request)
    {
        $email = $request->email;
        if (User::where("email", $email)->doesntExist()) {
            ///the user has not found in the database
            response(["msg:" => "email is Invalid"], 401);
        }
        ////create random token
        $token = rand(100, 100000);
        try {
            ///try insert to the database and send an email
            DB::table("password_reset_tokens")->insert([
                "email" => $email,
                "token" => $token,
                "created_at" => Carbon::now(),
            ]);

            return response([
                "msg:" => "Please use this token to set a new password",
                "token" => $token,

            ], 200);
        } catch (\Exception $exception) {
            return response(['msg' => $exception->getMessage()], 400);
        }
    }
}
// ////send an email
            // Mail::to($email)
            //     ->send(new ForgetMail($token))
            //     ->from(config('mail.from.address'), config('mail.from.name'));
