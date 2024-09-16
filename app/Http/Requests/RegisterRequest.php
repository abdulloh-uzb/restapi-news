<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



/**
 * @OA\Schema(
 *     schema="RegisterRequest",
 *     type="object",
 *     required={"name","email","password","password_confirmation"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="name of user"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="name of email"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         description="password"
 *     ),
 *    @OA\Property(
 *         property="password_confirmation",
 *         type="string",
 *         description="repeat password"
 *     ),
 *    @OA\Property(
 *         property="image",
 *         type="string",
 *         description="profile picture of the user",
 *         nullable=true
 *     ),
 * )
 */
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:255|min:5",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|min:6",
            "password_confirmation" => "same:password",
            "image" => "nullable|mimes:jpg,jpeg,png",
        ];
    }
}
