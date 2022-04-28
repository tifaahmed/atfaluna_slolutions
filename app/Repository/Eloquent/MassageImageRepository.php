<?php

namespace App\Repository\Eloquent;

use App\Models\Massage_image as ModelName;
use App\Repository\MassageImageRepositoryInterface;
use App\Models\Massage;

class MassageImageRepository extends BaseRepository implements MassageImageRepositoryInterface
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

    public function attachMassage($massage_image_id, $id)
	{
		$massage_image = $this->findById($id);

		$massage_image_massages = $massage_image->massage()->get();

		foreach ($massage_image_massages as $key => $value){
			$value->massagable()->dissociate()->save();
		}
		$massage = Massage::find($massage_image_id);
		$massage->massagable()->associate($massage_image)->save();

	}
}

//public function attachMassage($massage_image, $id)
//{$massage_image = $this->findbyid($id);
//$massage_image_massages = $massage_image->massage()->get();
//foreach ($massage_image_massages as $key => $value ){
//$value->massagable()->dissociate()->save();}
//$massage = Massage::find($massage_image_id);
//$massage->massagable()->associate($massage_image)->save();}
