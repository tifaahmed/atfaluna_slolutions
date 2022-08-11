<?php

namespace App\Repository;

interface LessonRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id,$lesson_type_id,$hero_id,$watch_status,$age_group_id)  ;
	public function filterPaginate($sub_user_id,$lesson_type_id,$hero_id,$watch_status,$age_group_id,$itemsNumber)  ;
	public function attachQuiz($quiz_ids,$id)  ;
	public function handleLessson($sub_user_id,$lesson_id,$percentage,$game_data)  ;
	public function attachSkills($skill_ids,$id)  ;
}