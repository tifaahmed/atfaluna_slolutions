<?php

namespace App\Http\Resources\Mobile\Activity;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\Storage;

use App\Models\Basic;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->activity_languages()->Localization()->RelatedLanguage($this->id)->first();
        $basic = Basic::find(1);
        return [
            'id'            => $this->id,    
            'image_one'     =>( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? asset(Storage::url($row->image_one))  : asset(Storage::url($basic->item)),
            'image_two'     =>( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? asset(Storage::url($row->image_two))  : asset(Storage::url($basic->item)),
            'url'           =>( $row && $row->url       && Storage::disk('public')->exists($row->url) )? asset(Storage::url($row->url))  : asset(Storage::url($basic->item)),

            'name'          => $row ? $row->name:'',

            'points'        => $this->points ,

            'lesson'        =>  $this->lesson   ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];         
    }
}
//