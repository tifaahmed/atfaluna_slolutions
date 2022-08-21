<?php

namespace App\Http\Resources\Mobile\ControllerResources\DurationTimeController;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

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
        Carbon::setLocale(App::getLocale());

        switch ($this->created_at ?  Carbon::parse($this->created_at)->dayOfWeek  : null) {
            case "6":
                $day_of_week = 0;
              break;
            case "0":
              $day_of_week = 1;
              break;
            case "1":
              $day_of_week = 2;
              break;
            case "2":
                $day_of_week = 3;
                break;
            case "3":
                $day_of_week = 4;
                break;
            case "4":
                $day_of_week = 5;
                break;  
            case "5":
                $day_of_week = 6;
                break;     
            default:
            $day_of_week = 0;
        };

        


        return [
            'id'            => $this->id,

            'time_count'         => number_format((float)$this->time_count, 2, '.', '')   ,

            'day_of_week'         => $day_of_week,
            'day_number'         => $this->created_at ?   $this->created_at->format('d') : null,
            'day_name'         => $this->created_at ?   $this->created_at->format('D') : null,
            
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,

        ];        
    }
}
