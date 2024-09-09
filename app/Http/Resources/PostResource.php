<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            "id" => $this->id,
            "title" => $this->title_uz,
            "category"=>$this->category->name_uz,
            "image" => $this->image ?? "rasm mavjud emas",
            "views" => $this->views ?? 0
        ];
    }
}
