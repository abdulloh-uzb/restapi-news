<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StorePostRequest",
 *     type="object",
 *     required={"title_uz", "title_ru", "body_uz", "body_ru"},
 *     @OA\Property(
 *         property="title_uz",
 *         type="string",
 *         description="Title of the post"
 *     ),
 *     @OA\Property(
 *         property="title_ru",
 *         type="string",
 *         description="Content of the post"
 *     ),
 *     @OA\Property(
 *         property="body_uz",
 *         type="string",
 *         description="Content of the post"
 *     ),
 *    @OA\Property(
 *         property="body_ru",
 *         type="string",
 *         description="Content of the post"
 *     ),
 *    @OA\Property(
 *         property="category_id",
 *         type="integer",
 *         description="Content of the post"
 *     ),
 *     @OA\Property(
 *         property="tags",
 *         type="object",
 *         description="Content of the post"
 *     )
 * )
 */

class StorePostRequest extends FormRequest
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
            "title_uz"=> "required|string|max:255",
            "title_ru"=> "nullable|string|max:255",
            "body_uz" => "required|string",
            "body_ru" => "nullable|string",
            "image" => "nullable|string|max:255",
            "tags" => "nullable|array",
            "tags.*"=>"nullable|string",
            "category_id" => "required"
        ];
    }
}
