<?php
namespace App\Http\Resources\Mobile\ControllerResources\AchievementController;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Mobile\ControllerResources\AchievementController\AchievementImageResource ;

class AchievementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $row=$this->achievement_languages()->Localization()->RelatedLanguage($this->id)->first();

        return [
            'id'            => $this->id,
            'name'          => $row ? $row->name:'',
            'description'   => $row ? $row->description:'',
            'language'      => $row ? $row->language:'',

            'achivement_images'      => AchievementImageResource::collection($this->achivementImages),
        ];        
    }
}
