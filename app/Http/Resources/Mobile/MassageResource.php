<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Avatar;   
use App\Models\Massage_image;   
use App\Models\Hero;   
use Illuminate\Support\Facades\Storage;


class MassageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    { 
        $all = [];
        $all += array('id'                => $this->id);
        $all += array('text'              => $this->text);
        $all += array('sub_user_id'       => $this->sub_user_id);

        switch ($this->massagable_type) {
            case Avatar::class:
                $image =  $this->massagable->skins()->Original()->first()->image ;
                break;
            case Massage_image::class:
                $image = $this->massagable->image ;
                break;
            case Hero::class:  
                $image = $this->massagable->hero_languages()->Localization()->first()->image ;
                break;
            default:
                $image = '';
        }
        
        $all += array('image' =>  Storage::disk('public')->exists($image) ? asset(Storage::url($image))  : null,    );


        return $all;
    }
}      

