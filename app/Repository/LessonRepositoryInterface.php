<?php

namespace App\Repository;

interface LessonRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id,$lesson_type_id,$hero_id)  ;
	public function filterPaginate($sub_user_id,$lesson_type_id,$hero_id,$itemsNumber)  ;
	public function attachQuiz($quiz_ids,$id)  ;
	public function attachLessson($sub_user_id,$lesson_id)  ;
	// public function attachCertificate($sub_user_id,$lesson_id)  ;

}
