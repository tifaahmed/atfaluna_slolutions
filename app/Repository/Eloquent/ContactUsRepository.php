<?php

namespace App\Repository\Eloquent;

use App\Models\Contact_us as ModelName;
use App\Repository\ContactUsRepositoryInterface;

class ContactUsRepository extends BaseRepository implements ContactUsRepositoryInterface
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




	
}

