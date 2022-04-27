<?php

namespace App\Repository\Eloquent;

use App\Models\Age_group as ModelName;
use App\Repository\AgeGroupRepositoryInterface;
use App\Models\Certificate;             // morphedByMany

class AgeGroupRepository extends BaseRepository implements AgeGroupRepositoryInterface
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

	public function attachCertificate($certificate_id,$id)  
    {
		// if($certificate_id){
			$age_group = $this->findById($id); 
			
			$age_group_certificates =  $age_group->certificate()->get();
			foreach ($age_group_certificates as $key => $value) {
				$value->certificatable()->dissociate()->save();
			}

			$certificate =  Certificate::find($certificate_id);
			$certificate->certificatable()->associate($age_group)->save();
		// }
	}


	
}

