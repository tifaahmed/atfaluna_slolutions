<?php

namespace App\Repository;

interface HeroRepositoryInterface extends EloquentRepositoryInterface{
    public function filterAll($sub_user_id)  ;
    public function attachLessons($lesson_ids,$id);
	public function attachMassage($massage_id,$id)  ;

}
