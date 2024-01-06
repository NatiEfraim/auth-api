<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser()
    {
        $user = auth()->user();
        ////diffine and set all the field that the frontend need
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => Carbon::parse($user->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($user->updated_at)->format('d/m/Y'),
        ];
    }
}
