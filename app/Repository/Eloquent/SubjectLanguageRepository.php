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

	public function attachSoundas($sound_id,$id)
	{
		if($sound_id){
			$result = $this->findById($id); 
			return $result->sounds()->sync($sound_id);
		}
	}


	
}

