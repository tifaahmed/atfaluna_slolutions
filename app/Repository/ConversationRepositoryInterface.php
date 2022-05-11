<?php

namespace App\Repository;

interface ConversationRepositoryInterface extends EloquentRepositoryInterface{
	public function store($sub_user_id,$recevier_ids,$type)  ;

}
