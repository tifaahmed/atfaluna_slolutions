<?php

namespace App\Http\Resources\Mobile\Skill;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Basic;
use Illuminate\Support\Facades\Storage;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    $row=$this->skill_languages()->Localization()->RelatedLanguage($this->id)->first();
    $basic = Basic::find(1); //logo

        return [
            'id'            => $this->id,

            'name'          => $row ? $row->name:'',
            'image'          =>( $row && $row->image && Storage::disk('public')->exists($row->image) )? asset(Storage::url($row->image))  : asset(Storage::url($basic->item)),

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,


        ];        
    }
}
//