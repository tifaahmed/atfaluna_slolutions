<?php

namespace App\Repository;

interface SubSubjectRepositoryInterface extends EloquentRepositoryInterface{
	public function filterPaginate($subject_id,int $itemsNumber)  ;
	public function filterAll($subject_id)  ;
}
