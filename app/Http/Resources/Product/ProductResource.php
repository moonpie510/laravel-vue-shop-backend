<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Color\ColorResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = Product::query()->where('group_id', $this->group_id)->get();

        return [
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'image_url' => $this->imageUrl,
            'price' => $this->price,
            'count' => $this->count,
            'is_published' => $this->is_published,
            'category' => new ColorResource($this->category),
            'group_products' => ProductMinResource::collection($product),
        ];
    }
}