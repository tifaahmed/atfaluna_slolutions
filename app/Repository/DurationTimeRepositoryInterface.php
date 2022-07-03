<?php

namespace App\Repository;

interface DurationTimeRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($type,$sub_user_id)  ;
}
