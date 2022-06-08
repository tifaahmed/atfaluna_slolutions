<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_subject_language as ModelName;
use App\Repository\SubSubjectLanguageRepositoryInterface;

class  SubSubjectLanguageRepository extends BaseRepository implements SubSubjectLanguageRepositoryInterface
{

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository  constructor
	 * @param  Model $model
	 */
	public function __construct(ModelName $model)
	{
		$this->model =  $model;
	}

	public function attachSoundas($sound_id,$subject_language_id)
	{
		if($sound_id){
			$result = $this->findById($subject_language_id); 
			return $result->sound()->sync($sound_id);
		}
	}


	
}

