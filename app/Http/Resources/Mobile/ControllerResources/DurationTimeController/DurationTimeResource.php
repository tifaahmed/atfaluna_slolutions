<?php

namespace App\Http\Resources\Mobile\ControllerResources\DurationTimeController;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
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

            'time_count'         => number_format((float)$this->time_count, 2, '.', '')   ,

            'day_of_week'         => $this->created_at ?  Carbon::parse($this->created_at)->dayOfWeek  : null,
            'day_number'         => $this->created_at ?   $this->created_at->format('d') : null,
            'day_name'         => $this->created_at ?   $this->created_at->format('D') : null,
            
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,


        ];        
    }
}
