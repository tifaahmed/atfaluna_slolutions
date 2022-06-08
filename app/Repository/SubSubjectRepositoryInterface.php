<?php

namespace App\Repository;

interface SubSubjectRepositoryInterface extends EloquentRepositoryInterface{
	public function filterPaginate($subject_id,int $itemsNumber)  ;
	public function filterAll($subject_id)  ;
	public function attachQuiz($quiz_id,$id)  ;
	public function attachSkills($skill_ids,$id)  ;

}
