<?php

namespace App\Repository;

interface SubjectRepositoryInterface extends EloquentRepositoryInterface{
	public function filterPaginate($sub_user_id,$age_group_id, int $itemsNumber)  ;
	public function filterAll($sub_user_id,$age_group_id)  ;
	public function attachQuiz($quiz_id,$id)  ;
}
