<?php

namespace App\Http\Resources;

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
        return [
            'product_id'    => $this->id,
            'product_name'  => $this->name,
            'price'         => $this->price,
            'description'   => $this->description,
            'stock'         => $this->stock,
            'discount'      => $this->discount??null,
            'category_name' => $this->category->name
        ];
    }
}
