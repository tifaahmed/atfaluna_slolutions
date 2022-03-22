<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\CertificateResource;
use App\Http\Resources\Mobile\Collections\SubSubject\SubSubjectCollection;
use App\Http\Resources\Mobile\Collections\QuizCollection;

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
            'name'          => $this->name,
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,
            'points'        => $this->points,
            
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
            'languages'     => $this->Subject_language,
            
            'name'          => $row ? $row->name:'',

            'sub_subjects'        => new SubSubjectCollection  ($this->sub_subjects),
            'certificate'        =>  new CertificateResource  ($this->certificate),
            'quizzes'              =>  new QuizCollection  ($this->quizzes),
            
        ];        
    }
}
//
