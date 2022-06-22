<?php

namespace App\Repository;

interface AvatarRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($gender)  ;
	public function filterPaginate($gender,int $itemsNumber)  ;

}
