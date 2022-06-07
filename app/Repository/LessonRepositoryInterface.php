<?php

namespace App\Repository;

interface LessonRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id,$lesson_type_id,$hero_id)  ;
	public function filterPaginate($sub_user_id,$lesson_type_id,$hero_id,$itemsNumber)  ;
	public function attachQuiz($quiz_ids,$id)  ;
	public function handleLessson($sub_user_id,$lesson_id,$received_lesson_points)  ;
	public function attachSkills($skill_id,$id)  ;
}
