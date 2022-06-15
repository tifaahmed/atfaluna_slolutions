<?php

namespace App\Http\Resources\Mobile\ControllerResources\SkillController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Basic;
use Illuminate\Support\Facades\Storage;
use Auth;
class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $row            =  $this->skill_languages()->Localization()->RelatedLanguage($this->id)->first();
        $basic          =  Basic::find(1); //logo
        $seen = 0 ;
        if ( isset( $request->sub_user_id ) && $request->sub_user_id ) {
            $sub_user       =  Auth::user()->sub_user()->find($request->sub_user_id);
            $subjects       =  $sub_user->subUserSubject()->get();
            $sub_subjects   =  $sub_user->subUserSubSubject()->get();
            $lessons        =  $sub_user->subUserLesson()->get();
            $seen = 0 ;
            foreach ($subjects as $key => $value) {
                $seen = $value->skills()->find($this->id) ? 1 : $seen ;
            }
            foreach ($sub_subjects as $key => $value) {
                $seen = $value->skills()->find($this->id) ? 1 : $seen ;
            }
            foreach ($lessons as $key => $value) {
                $seen = $value->skills()->find($this->id) ? 1 : $seen ;
            }
        }



        return [
            'id'            => $this->id,

            'name'               => $row ? $row->name:'',

            'image'          => 
                ( !$seen ) ? 
                    ( 
                        ( $row && $row->image_one && Storage::disk('public')->exists($row->image_one) )? 
                        asset(Storage::url($row->image_one))  
                        : 
                        asset(Storage::url($basic->item)) 
                    ) 
                    : 
                    ( 
                        ( $row && $row->image_two && Storage::disk('public')->exists($row->image_two) )? 
                        asset(Storage::url($row->image_two))  
                        : 
                        asset(Storage::url($basic->item)) 
                    ) 
            ,
            'taken'               => $seen ? 1:0,
            // 'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            // 'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            // 'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,


        ];        
    }
}
//