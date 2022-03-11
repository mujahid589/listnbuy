<?php

namespace Modules\CustomerAd\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AdGalleriesResource extends JsonResource
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
            'ad_id' => $this->ad_id,
            'image' => $this->image,
        ];;
    }
}
