<?php

namespace App\Http\Resources\Mobile\ControllerResources\SubjectController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
// Resource
use App\Http\Resources\Mobile\ControllerResources\SubjectController\QuizResource;
use App\Http\Resources\Mobile\ControllerResources\SubjectController\CertificateResource;
use App\Http\Resources\Mobile\ControllerResources\SubjectController\SubSubjectResource;

use App\Models\Basic;
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

        return [
            'id'                 => $this->id,
            'image'              => Storage::disk('public')->exists($this->image) ? asset(Storage::url($this->image))  :  asset(Storage::url($basic->item)),
            'points'             => $this->points,
            
            'name'               => $row ? $row->name:'',
            'sound'               =>  ( $row && $row->sound->count() && Storage::disk('public')->exists($row->sound[0]->record) ) ? asset(Storage::url($row->sound[0]->record))  :  null ,
            'sound_id'            =>  ( $row && $row->sound->count() ) ?  $row->sound[0]->id : null ,

            'sub_subjects'       =>  SubSubjectResource::collection($this->sub_subjects),

            'quiz'               =>   new QuizResource ( $this->quiz )   ,
            'certificate'        =>   new CertificateResource ( $this->certificate )   ,
            
            
        ];        
    }
}
//
