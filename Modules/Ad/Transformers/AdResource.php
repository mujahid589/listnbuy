<?php

namespace Modules\Ad\Transformers;

use App\Http\Resources\CustomerResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\CategoryResource;
use Modules\Location\Transformers\CityResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail,
            'price' => $this->price,
            'featured' => $this->featured,
            'total_views' => $this->total_views,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'city' => new CityResource($this->whenLoaded('city')),
            'customer' => new CustomerResource($this->whenLoaded('customer')),
//            'created_at' => $this->created_at->diffForHumans(),
            'created_at' =>$this->created_at ? $this->created_at->diffForHumans(): '-'
        ];
    }
}
