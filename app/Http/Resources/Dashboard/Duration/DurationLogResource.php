<?php

namespace App\Http\Resources\Dashboard\Duration;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\SubUserResource;

class DurationLogResource extends JsonResource
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
            'id'            => $this->id,

            'start'         => $this->start,

            'sub_user'          => new SubUserResource (  $this->sub_user )  ,

        ];        
    }
}
