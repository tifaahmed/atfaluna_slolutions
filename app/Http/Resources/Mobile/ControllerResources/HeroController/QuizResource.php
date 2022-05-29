<?php

namespace App\Http\Resources\Mobile\ControllerResources\HeroController;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->quiz_languages()->Localization()->RelatedLanguage($this->id)->first();
        $basic = Basic::find(1); //logo

        return [
            'id'            => $this->id,

            'image_one'          =>( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item)),
            'image_two'          =>( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item)),
            'name'               => $row ? $row->name:'',
            'points'             => $this->points,

            'created_at'         => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'         => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

        ];        
    }
}
