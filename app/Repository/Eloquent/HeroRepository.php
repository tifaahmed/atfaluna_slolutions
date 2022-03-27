<?php

namespace App\Repository\Eloquent;

use App\Models\Hero as ModelName;
use App\Repository\HeroRepositoryInterface;

class HeroRepository extends BaseRepository implements HeroRepositoryInterface
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

    public function attachLessons($lesson_ids,$id)
	{
		if($lesson_ids && $id){
			$result = $this->findById($id); 
			$result->herolesson()->sync($lesson_ids);
			return 'success';
		}
	}


	
}

