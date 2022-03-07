<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Dashboard\AvatarResource;
use App\Http\Resources\Dashboard\UserResource;

use App\Http\Resources\Dashboard\Collections\AvatarCollection;
use App\Http\Resources\Dashboard\Collections\AccessoryCollection;
use App\Http\Resources\Dashboard\Collections\CertificateCollection;
use App\Http\Resources\Dashboard\Collections\QuizCollection;
use App\Http\Resources\Dashboard\Collections\LessonCollection;
use App\Http\Resources\Dashboard\Collections\SubjectCollection;

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

            'user'              => new UserResource ( $this->user ),
            'avatar'            => new AvatarResource (  $this->avatar )  ,
            
            'accessories'    => new AccessoryCollection ($this->subUserAccessory)  ,
            'avatars'        => new AvatarCollection ($this->subUserAvatar)  ,
            'certificate'    => new CertificateCollection ($this->subUserCertificate)  ,
            'quizs'          => new QuizCollection ($this->subUserQuiz)  ,
            'lessons'        => new LessonCollection ($this->subUserLesson)  ,
            'subjects'       => new SubjectCollection ($this->subUserSubject)  ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
