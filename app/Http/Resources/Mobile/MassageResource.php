<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\AvatarResource;
use App\Http\Resources\Mobile\MassageImageResource;
use App\Http\Resources\Mobile\Hero\HeroResource;

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

            if( $this->massagable_type == 'App\Models\Avatar' ){
                $all += array('image'            => new AvatarResource ( $this->massagable ) );
            }else if( $this->massagable_type == 'App\Models\Massage_image' ){
                $all += array('image'            => new MassageImageResource ( $this->massagable ) );
            }else if( $this->massagable_type == 'App\Models\Hero' ){
                $all += array('image'            => new HeroResource ( $this->massagable ) );
            }
            return $all;
    }
}
