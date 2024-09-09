<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
