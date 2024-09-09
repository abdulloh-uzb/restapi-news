<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            "title_uz" => "sometimes|required|string|max:255",
            "title_ru" => "sometimes|required|string|max:255",
            "body_uz" => "sometimes|required|string",
            "body_ru" => "sometimes|required|string",
            "image" => "sometimes|string|max:255",
            "category_id" => "sometimes|required|exists:categories,id"
        ];
    }
}
