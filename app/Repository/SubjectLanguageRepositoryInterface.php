<?php

namespace App\Repository;

interface SubjectLanguageRepositoryInterface extends EloquentRepositoryInterface{
	public function attachSoundas($sound_id,$id)  ;

}
