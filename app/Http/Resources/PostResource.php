<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;




/**
 * @OA\Schema(
 *     schema="PostResource",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the post"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Title of the post"
 *     ),
 *     @OA\Property(
 *         property="category",
 *         type="string",
 *         description="category of the post"
 *     ),
 *     @OA\Property(
 *         property="image",
 *         type="string",
 *         description="Image of the post"
 *     ),
 *     @OA\Property(
 *         property="views",
 *         type="integer",
 *         description="views of the post"
 *     )
 * )
 */

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
            "category" => $this->category->name_uz,
            "image" => $this->image ?? "rasm mavjud emas",
            "views" => $this->views ?? 0
        ];
    }
}
