<?php

namespace App\Repository;

interface ActivityRepositoryInterface extends EloquentRepositoryInterface{
    public function filterPaginate($lesson_id,int $itemsNumber)  ;
	public function filterAll($lesson_id)  ;
    public function handleActivity($sub_user_id,$activity_id,$percentage)  ;
}
