<?php

namespace App\Repository\Eloquent;

use App\Models\BodySuit as ModelName;
use App\Repository\BodySuitRepositoryInterface;

class BodySuitRepository extends BaseRepository implements BodySuitRepositoryInterface
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

	public function attachHumanPart($human_part_ids,$body_suit_id)
	{
		if($human_part_ids && $body_suit_id){
			$body_suit = $this->findById($body_suit_id); 
			$body_suit->bodySuit_humanParts()->sync($human_part_ids);
			return 'success';
		}
	}
}