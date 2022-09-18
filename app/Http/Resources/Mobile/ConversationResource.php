<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\Mobile\Collections\MassageCollection;
use App\Http\Resources\Mobile\MassageResource;

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
        if (!$this->title) {
            $group_chats = $this->group_chats()->get();
            $group_chat_names = ' ';
            foreach ($group_chats as $key => $group_chat) {
                $group_chat_names = $key == 0 ?  $group_chat->subUser->name :  $group_chat_names.','.$group_chat->subUser->name;
            }
            $title = $group_chat_names;
            
        }else {
            $title = $this->title;
        }
         
        return [
            'id'               => $this->id,
            'title'            => $title,
            'type'             =>  $this->type,

            // 'created_at'    => $this->created_at ?   $this->created_at->format('d/m/Y') : null,
            // 'updated_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,
            // 'deleted_at'    => $this->updated_at ?   $this->updated_at->format('d/m/Y') : null,

            'last_massage'       =>   new MassageResource ( $this->massages()->latest()->first() )   ,
            

        ];        
    }
}
