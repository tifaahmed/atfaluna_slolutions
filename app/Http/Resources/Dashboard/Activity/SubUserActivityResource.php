<?php

namespace App\Http\Resources\Dashboard\Activity;

use Illuminate\Http\Resources\Json\JsonResource;

class SubUserActivityResource extends JsonResource
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
            'id'                      => $this->id,
            'sub_user_id'             => $this->sub_user_id,
            'activity_id'             => $this->activity_id,
            'points'                  => $this->points,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

        ];        
    }
}
