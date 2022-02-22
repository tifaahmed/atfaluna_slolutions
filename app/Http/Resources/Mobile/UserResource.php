<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\mobile\CountryResource;

class UserResource extends JsonResource
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
            'id'             => $this->id,
            'name'           => $this->name,
            'email'          => $this->email,
            'phone'          => $this->phone,
            'avatar'         => Storage::disk('public')->exists($this->avatar) ? Storage::url($this->avatar)  : null,

            'birthdate'        => $this->birthdate,
            'country'          => new CountryResource ( $this->country ),

            'UserRoles'      => $this->UserRole,
            'UserPermissions'=> $this->UserPermission,

            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

            
        ];
    }
}

