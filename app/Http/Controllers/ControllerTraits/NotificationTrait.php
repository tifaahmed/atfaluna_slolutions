<?php

namespace App\Http\Controllers\ControllerTraits;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NewItemNotification;


use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Http\JsonResponse ;
use App\Models\User;
use App\Models\Basic;


trait NotificationTrait {

    // * @param  array $notification
	// * @param  string $priority (high & normal)
	// * @param  string $image
	// * @param  string $model_name (model)
	// * @param  integer $model_id (model)
	
	// @return nothing

    public function TraitNotification($notification_data,$priority,$image,$model_name,$model_id){
		$basic = Basic::find(1);

		if (!$image) {
			$image = asset(Storage::url($basic->item)) ;
		}

		for ($i=0; $i < count($notification_data) ; $i++) { 
			$notification_data[$i]['priority']   	= $priority;
			$notification_data[$i]['image'] 		= $image;
			$notification_data[$i]['model_name']    = $model_name;
			$notification_data[$i]['model_id']      = $model_id;
		}
		$user = new User;
		$user->sendNewItemNotification($notification_data);
    }
}