<?php

namespace App\Http\Resources\Mobile\Duration;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\SubUserResource;

class DurationTimeResource extends JsonResource
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

            'time'         => $this->time,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,

            'sub_user'          => new SubUserResource (  $this->sub_user )  ,

        ];        
    }
}
