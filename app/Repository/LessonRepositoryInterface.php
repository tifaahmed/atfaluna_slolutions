<?php

namespace App\Repository;

interface LessonRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id,$lesson_type_id,$hero_id,$seen)  ;
	public function filterPaginate($sub_user_id,$lesson_type_id,$hero_id,$seen,$itemsNumber)  ;
	public function attachQuiz($quiz_ids,$id)  ;
	public function handleLessson($sub_user_id,$lesson_id,$percentage)  ;
	public function attachSkills($skill_ids,$id)  ;
}