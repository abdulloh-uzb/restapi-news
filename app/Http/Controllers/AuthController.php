<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\EmailConfirmation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            "name" =>"required|max:255|min:5",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|min:6",
            "password_confirmation" => "same:password",
            "image" => "nullable|mimes:jpg,jpeg,png",
        ]);

        $user = User::create($validated);

        $code = rand(100000, 999999);
        Mail::to($user)->send(new EmailConfirmation($code));

        return response()->json([
            "message"=> "Confirmation code was sent successfully!"
        ]);

    }
}
