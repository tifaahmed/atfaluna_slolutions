<?php

namespace App\Repository\Eloquent;

use App\Models\Subject_language as ModelName;
use App\Repository\SubjectLanguageRepositoryInterface;
use App\Models\Sound;             // morphedByMany

class SubjectLanguageRepository extends BaseRepository implements SubjectLanguageRepositoryInterface
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

