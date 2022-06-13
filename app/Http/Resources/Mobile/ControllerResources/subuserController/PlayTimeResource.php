<?php

namespace App\Http\Resources\Mobile\ControllerResources\subuserController;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayTimeResource extends JsonResource
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
            'day'           => $this->day,
            'status'        => $this->status,
            'start'         => $this->start,
            'end'           => $this->end,
        ];        
    }
}
