<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Mobile\Collections\MassageCollection;

class ConversationResource extends JsonResource
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
            'id'               => $this->id,
            'title'            => $this->title,
            'type'             =>  $this->type,
            'read'             => $this->read,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

            'massages'       =>   new MassageCollection ($this->massages)   ,

        ];        
    }
}
