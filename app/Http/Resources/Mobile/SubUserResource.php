<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\Collections\AvatarCollection;
use App\Http\Resources\Mobile\Collections\AccessoryCollection;
use App\Http\Resources\Mobile\Collections\CertificateCollection;
use App\Http\Resources\Mobile\Collections\Quiz\QuizCollection;
use App\Http\Resources\Mobile\Collections\Lesson\LessonCollection;
use App\Http\Resources\Mobile\Collections\SubjectCollection;


class SubUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $SubUserActiveAgeGroup = $this->SubUserActiveAgeGroup() 
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'age'           => $this->age,
            'gender'        => $this->gender,
            'points'        => $this->points,

            'accessories'    => new AccessoryCollection ($this->subUserAccessory)  ,
            'avatars'        => new AvatarCollection ($this->subUserAvatar)  ,
            'certificate'    => new CertificateCollection ($this->subUserCertificate)  ,
            'quizs'          => new QuizCollection ($this->subUserQuiz)  ,
            'lessons'        => new LessonCollection ($this->subUserLesson)  ,
            'active_age_group'  => $this->ActiveAgeGroup()->first()  ,
            'active_subjects_from_active_age_group'  =>  $this->ActiveSubjectsFromActiveAgeGroup()->get()   ,
            'user'         => $this->user,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
