<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\Collections\AvatarCollection;
use App\Http\Resources\Dashboard\Collections\AccessoryCollection;
use App\Http\Resources\Dashboard\Collections\CertificateCollection;
use App\Http\Resources\Dashboard\Collections\Quiz\QuizCollection;
use App\Http\Resources\Dashboard\Collections\Lesson\LessonCollection;
use App\Http\Resources\Dashboard\Collections\SubjectCollection;
use App\Http\Resources\Dashboard\Collections\SubSubject\SubSubjectCollection;
use App\Http\Resources\Dashboard\Collections\AgeGroupCollection;
use App\Http\Resources\Dashboard\Collections\Achievement\AchievementCollection;

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
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'age'           => $this->age,
            'gender'        => $this->gender,
            'points'        => $this->points,
            'user'          =>  $this->user ,
        //Avatar
            'avatars'      => new AvatarCollection ($this->subUserAvatar)  ,
        //Accessory
            'accessories' => new AccessoryCollection ($this->subUserAccessory)  ,
        //Subject
            'subjects'     => new SubjectCollection ($this->subUserSubject)  ,
        //Sub_Subject
            'sub_subjects'     => new SubSubjectCollection ($this->subUserSubSubject)  ,
        //Lesson
            'lessons'      => new LessonCollection ($this->subUserLesson)  ,
        //Quiz
            'quizs'        => new QuizCollection ($this->subUserQuiz)  ,
        //Certificate
            'certificates'  => new CertificateCollection ($this->subUserCertificate)  ,
        //Achievement
            'achievements' => new AchievementCollection ($this->subUserAchievement)  ,            
        //AgeGroup
            'sub_user_age_group'  => new AgeGroupCollection ($this->subUserAgeGroup)  ,

            'active_age_group'    => $this->ActiveAgeGroup() ? $this->ActiveAgeGroup()->first()  : null ,

            'active_subjects_from_active_age_group'  =>  $this->ActiveSubjectsFromActiveAgeGroup() ? $this->ActiveSubjectsFromActiveAgeGroup()->get() : []   ,

            'created_at'            => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'            => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'            => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
