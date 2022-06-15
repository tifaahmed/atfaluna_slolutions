<?php

namespace App\Repository;

interface SkillRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id);  
	public function filterPaginate($sub_user_id, int $itemsNumber)  ;
}
