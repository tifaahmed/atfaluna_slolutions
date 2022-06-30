<?php

namespace App\Repository\Eloquent;

use App\Models\Accessory as ModelName;
use App\Repository\AccessoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AccessoryRepository extends BaseRepository implements AccessoryRepositoryInterface
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
    public function attachActivities($activity_ids,$accessory_id)
	{
		if($activity_ids && $accessory_id){
			$accessory = $this->findById($accessory_id); 
			$accessory->AccessoryActivity()->sync($activity_ids);
			return 'success';
		}
	}
	public function attachLessons($lesson_ids,$accessory_id)
	{
		if($lesson_ids && $accessory_id){
			$accessory = $this->findById($accessory_id); 
			$accessory->AccessoryLesson()->sync($lesson_ids);
			return 'success';
		}
	}
	public function attachSkins($skin_ids,$accessory_id)
	{
		if($skin_ids && $accessory_id){
			$accessory = $this->findById($accessory_id); 
			$accessory->AccessorySkin()->sync($skin_ids);
			return 'success';
		}
	}
}