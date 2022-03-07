<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\AvatarResource;
use App\Http\Resources\Mobile\AccessoryResource;
use App\Http\Resources\Mobile\CertificateResource;
use App\Http\Resources\Mobile\QuizResource;
use App\Http\Resources\Mobile\LessonResource;
use App\Http\Resources\Mobile\SubjectResource;

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
            'avatar'        => new AvatarResource ($this->avatar)  ,
            'accessory'     => new AccessoryResource ($this->accessory)  ,
            'certificate'   => new CertificateResource ($this->certificate)  ,
            'quiz'          => new QuizResource ($this->quiz)  ,
            'lesson'        => new LessonResource ($this->lesson)  ,
            'subject'       => new SubjectResource ($this->subject)  ,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

        ];        
    }
}
