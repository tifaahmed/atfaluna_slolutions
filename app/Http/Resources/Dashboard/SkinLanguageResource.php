<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Dashboard\AvatarResource;

class SkinLanguageResource extends JsonResource
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
            'name'              => $this->name,
            'language'          => $this->language,
        ];        
    }
}


