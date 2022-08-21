<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\SubUserResource;

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
        switch ($this->day) {
            case "6":
                $day_name = 'Saturday';
              break;
            case "0":
              $day_name = 'Sunday';
              break;
            case "1":
              $day_name = 'Monday';
              break;
            case "2":
                $day_name = 'Tuesday';
                break;
            case "3":
                $day_name = 'Wednesday';
                break;
            case "4":
                $day_name = 'Thursday';
                break;  
            case "5":
                $day_name = 'Friday';
                break;     
            default:
            $day_name = null;
        };

        return [
            'id'            => $this->id,
            'day'           => $this->day,
            'status'        => $this->status,
            'start'         => $this->start,
            'end'           => $this->end,
            'day_name'         =>  $day_name,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];        
    }
}
