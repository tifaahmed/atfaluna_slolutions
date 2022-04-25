<?php

namespace App\Repository;

interface AvatarRepositoryInterface extends EloquentRepositoryInterface{
	public function filterPaginate($gender,$free,$sub_user_id,int $itemsNumber)  ;
	public function filterAll($gender,$free,$sub_user_id)  ;

}
