<?php

namespace App\Repository;

interface ConversationRepositoryInterface extends EloquentRepositoryInterface{
	public function checkExist($sub_user_id,$recevier_ids,$type)  ;

	
}
