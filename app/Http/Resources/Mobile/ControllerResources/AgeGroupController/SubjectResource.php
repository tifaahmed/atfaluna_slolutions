<?php

namespace App\Http\Resources\Mobile\ControllerResources\AgeGroupController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;

use App\Http\Resources\Mobile\Collections\ControllerResources\AgeGroupController\SubSubjectCollection;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->subject_languages()->Localization()->RelatedLanguage($this->id)->first();
        $basic = Basic::find(1);
        $sound = $this->sounds()->Localization()->first();

        return [
            'id'            => $this->id,
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  :  asset(Storage::url($basic->item)),
            // 'points'        => $this->points,
            
            // 'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            // 'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            // 'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
            
            'name'          => $row ? $row->name:'',

            'sub_subjects'       => new SubSubjectCollection  ($this->sub_subjects),
            'certification'     =>  new CertificateResource ($this->certificate)   

        ];        
    }
}
//
