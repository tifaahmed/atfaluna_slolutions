<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AboutUsResource extends JsonResource
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
            'subject'          => $this->subject,
            'image_one'        => Storage::disk('public')->exists($this->image_one) ? asset(Storage::url($this->image_one))  : null,
            'image_two'        => Storage::disk('public')->exists($this->image_two) ? asset(Storage::url($this->image_two))  : null,
            'image_three'      => Storage::disk('public')->exists($this->image_three) ? asset(Storage::url($this->image_three))  : null,
            'image_four'       => Storage::disk('public')->exists($this->image_four) ? asset(Storage::url($this->image_four))  : null,
            'language'         => $this->language,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

        ];        
    }
}
