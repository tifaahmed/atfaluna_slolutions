<?php

namespace App\Repository;

interface AvatarRepositoryInterface extends EloquentRepositoryInterface{
	public function filterPaginate($gender,int $itemsNumber)  ;
	public function filterFirst($free)  ;

}
