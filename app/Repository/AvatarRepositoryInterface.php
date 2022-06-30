<?php

namespace App\Repository;

interface AvatarRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id,$gender,$free,$bought)  ;
	public function filterPaginate($sub_user_id,$gender,$free,$bought,int $itemsNumber)  ;

}
