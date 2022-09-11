<?php

namespace App\Http\Resources\Mobile\ControllerResources\HeroController;
use App\Http\Resources\Mobile\Collections\ControllerResources\HeroController\LessonCollection;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Basic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class HeroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->hero_languages()->Localization()->RelatedLanguage($this->id)->first();
        $basic = Basic::find(1);

        if ($request->sub_user_id) {
            $sub_user       = Auth::user()->sub_user()->find($request->sub_user_id);
            $active_subjects = $sub_user->ActiveSubjectsFromActiveAgeGroup()->get() ;
            $result = new Collection; // to collect all lessons
            foreach ($active_subjects as $key => $value) {
                $lessons = $value->lessons()->get();
                $result = $result->merge( $lessons );
            }	
            $lessson_ids = $result->pluck('id')->toArray();
    
            $herolesson =  $this->herolesson->whereIn('id',$lessson_ids);
        }else {
            $herolesson = $this->herolesson;
        }
       
        return [
            'id'            => $this->id,
            'title'         => $row ? $row->title:'',
            'image'         =>( $row && $row->image && Storage::disk('public')->exists($row->image) )? asset(Storage::url($row->image))  : asset(Storage::url($basic->item)),
            'description'   => $row ? $row->description:'',

            'lessons'        => new LessonCollection ($herolesson)  ,

        ];        
    }
}