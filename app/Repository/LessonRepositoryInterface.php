<?php

namespace App\Repository;

interface LessonRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id,$lesson_type_id)  ;
	public function filterPaginate($sub_user_id,$lesson_type_id,$itemsNumber) ; 

}
