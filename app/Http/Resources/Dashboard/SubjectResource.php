<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\CertificateResource;
use App\Http\Resources\Dashboard\Collections\SubSubject\SubSubjectCollection;

use App\Http\Resources\Dashboard\Quiz\QuizResource;
 

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

        return [
            'id'            => $this->id,
            'image'         => Storage::disk('public')->exists($this->image) ? Storage::url($this->image)  : null,
            'points'        => $this->points,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'languages'     => $this->subject_languages,
            'name'          => $row ? $row->name:'',

            'age_group'     => $this->age_group,
            'sub_subjects'        => new SubSubjectCollection  ($this->sub_subjects),

            'certification' => new CertificateResource (  $this->certificate )  ,
            'quiz'          =>   new QuizResource ( $this->quiz )   ,

        ];        
    }
}
//
