<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
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
            "variant_product_code" => $this->variant_product_code,
            "variant_name" => $this->variant_name,
            "variant_description" => $this->variant_description,
            "variant_price" => $this->variant_price, 
            "variant_stock" => $this->variant_stock, 
            "product_id" => $this->product_id
        ];
    }
}