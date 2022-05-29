<?php

namespace App\Http\Resources\Mobile\ControllerResources\UserController;

use Illuminate\Http\Resources\Json\JsonResource;
class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->subscription_languages()->Localization()->RelatedLanguage($this->id)->first();
        $auth_created_at = new Carbon (Auth::user()->created_at);
        

        $allowed = 1 ;
        
        if ($this->price <= 0  &&  Auth::user() && Carbon::now() >= $auth_created_at ->addMonths($this->month_number)   ) {
            $allowed = 0;
        }

        return [
            'id'            => $this->id,
            'month_number'  => $this->month_number,
            'price'         => $this->price,
            
            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

            'languages'     => $this->subscription_languages,
            'name'          => $row ? $row->name:'',

            'allowed'          => $allowed ,
        ];          
    }
}
