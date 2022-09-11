<?php

namespace App\Http\Resources\Dashboard\ControllerResources\CertificateController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Age_group;
use App\Models\Subject;
use App\Http\Resources\Dashboard\ControllerResources\CertificateController\AgeGroupResource;
use App\Http\Resources\Dashboard\ControllerResources\CertificateController\SubjectResource;

class CertificateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->certificate_languages()->Localization()->RelatedLanguage($this->id)->first();
        $certificatable = null ;
        if ($this->certificatable_type == Age_group::class) {
        $certificatable =  new AgeGroupResource ($this->certificatable);
        }else if ($this->certificatable_type == Subject::class) {
            $certificatable =  new SubjectResource ($this->certificatable);
        }


        return [
            'id'               => $this->id,
            'image_one'        =>  Storage::disk('public')->exists($this->image_one) ? asset(Storage::url($this->image_one))  : null,
            'image_two'        =>  Storage::disk('public')->exists($this->image_two) ? asset(Storage::url($this->image_two))  : null,
            'image_three'      =>  Storage::disk('public')->exists($this->image_three) ? asset(Storage::url($this->image_three))  : null,
            'min_point'        =>  $this->min_point,
            'max_point'        =>  $this->max_point,
            'title_one'        => $row ? $row->title_one:'',
            'title_two'        => $row ? $row->title_two:'',
            'description'      => $row ? $row->description:'',

            'languages'        => $this->certificate_languages,
            'certificatable'     => $certificatable,

            'created_at'       => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'       => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'       => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
//