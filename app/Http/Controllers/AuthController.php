<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\EmailConfirmation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    /**
     * @OA\Post(
     * path = "/api/register",
     * summary = "Register",
     * tags={"Auth"},
     * @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     * ),
     * @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="User registered successfully")
     *         )
     *     ),
     * )
     */
    public function register(RegisterRequest $request)
    {

        $user = User::create($request->validated());
        $user->assignRole("user");
        $code = rand(100000, 999999);
        Mail::to($user)->send(new EmailConfirmation($code));

        return response()->json([
            "message" => "Confirmation code was sent successfully!",
            "token" => $user->createToken($user->name)->plainTextToken
        ]);
    }
    /**
     * @OA\Post(
     * path = "/api/login",
     * summary = "Login",
     * tags={"Auth"},
     * @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="User registered successfully")
     *         )
     *     ),
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => "required|email",
            "password" => "required",
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user ||  !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "Kiritilgan malumotlar xato"
            ]);
        }

        return response()->json([
            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "message" => "Logged out"
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/user",
     * security={{"bearerAuth":{}}},
     * summary="Get current logged user",
     * tags={"Users"},
     * @OA\Response(
     * response=200,
     * description="current user",
     * ),
     * )
     */

    public function getUser()
    {
        return  auth()->user()->roles->pluck('name');
    }
}
