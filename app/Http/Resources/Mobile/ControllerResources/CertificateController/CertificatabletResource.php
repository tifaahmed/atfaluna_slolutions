<?php

namespace App\Http\Resources\Mobile\ControllerResources\CertificateController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


use App\Models\Basic;
class CertificatabletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ( isset( $this->subject_languages ) ) {
            $relation = $this->subject_languages()->first();
        }else if ( isset( $this->age_group_languages ) ) {
            $relation = $this->age_group_languages()->first();
        }
        $row= $relation->Localization()->RelatedLanguage($this->id)->first();
        $basic = Basic::find(1);

        return [
            'id'                 => $this->id,
            'image'              => ( $this->image && Storage::disk('public')->exists($this->image) ) 
                                    ? asset(Storage::url($this->image))  
                                    :  
                                    asset(Storage::url($basic->item)),
            'name'               => $row ? 
                                            ($row->name) ?
                                                $row->name
                                            :
                                                $row->title_two
                                        :
                                        '',

        ];        
    }
}
//
