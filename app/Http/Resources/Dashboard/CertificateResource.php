<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
class CertificateResource extends JsonResource
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
            'relation_id'      =>  $this->relation_id,
            'relation_type'    =>  $this->relation_type,
            'image_one'        =>  $this->image_one,
            'image_two'        =>  $this->image_two,
            'min_point'        =>  $this->min_point,
            'max_point'        =>  $this->max_point,
            'min_point'        =>  $this->min_point,


            'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            'deleted_at'    => $this->deleted_at ?   $this->deleted_at->format('d/m/Y') : null,

            'languages'     => $this->Certificate_language,
        ];        
    }
}
//