<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>$this->image,
            'product_type'=>$this->product_type,
            'price'=>$this->price,
            'special_price'=>$this->special_price,
            'short_description'=>$this->short_description,
            'status'=>$this->status,
            'attributes'=>$this->attributes,
            'description'=>$this->description,
            'categories'=>CategoryResource::collection($this->categories),
            $this->mergeWhen($this->product_type=='bundle', [
                'bundle_items'=>ProductResource::collection($this->bundleItems)
            ]),
        ];
    }
}
