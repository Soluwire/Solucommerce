<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "product_code" => $this->product_code,
            "product_name" => $this->product_name,
            "product_description" => $this->product_description,
            "product_price" => $this->product_price,
            "category_id" => $this->category_id,
            "has_variants" => $this->has_variants
        ];
    }
}
