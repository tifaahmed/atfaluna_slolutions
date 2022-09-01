<?php

namespace App\Repository;

interface AvatarRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id,$gender,$free,$bought,$have_original_skin)  ;
	public function filterPaginate($sub_user_id,$gender,$free,$bought,$have_original_skin,int $itemsNumber)  ;

}
