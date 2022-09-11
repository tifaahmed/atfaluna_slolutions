<?php

namespace App\Http\Resources\Dashboard\ControllerResources\SubjectController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

use App\Http\Resources\Dashboard\Subject\SubjectLanguagesResource;
use App\Http\Resources\Dashboard\ControllerResources\SubjectController\CertificateResource;
use App\Http\Resources\Dashboard\ControllerResources\SubjectController\QuizResource;
use App\Http\Resources\Dashboard\ControllerResources\SubjectController\SubSubjectResource;
use App\Http\Resources\Dashboard\ControllerResources\SubjectController\SkillResource;
// use App\Http\Resources\Dashboard\Collections\SubSubject\SubSubjectCollection;
use App\Http\Resources\Dashboard\Collections\ControllerResources\SubjectController\SkillCollection ;


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
        $row = $this->subject_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'image'         => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  : null,
            'points'        => $this->points,
            'name'          => $row ? $row->name:'',
            'languages'     => SubjectLanguagesResource::collection( $this->subject_languages),

            'age_group'     => $this->age_group,

            'certificate'          =>   new CertificateResource ( $this->certificate )   ,

            'sub_subjects'  => SubSubjectResource::collection($this->sub_subjects),

            'skills'     => $this->skills,

            'quiz'          =>   new QuizResource ( $this->quiz )   ,

            // 'quiz'  => QuizResource::collection($this->quiz),

            // 'quiz'     => $this->quiz,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,
        ];        
    }
}

