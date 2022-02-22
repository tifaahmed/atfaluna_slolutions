<?php

namespace App\Repository\Eloquent;

use App\Models\Certificate_language as ModelName;
use App\Repository\CertificateLanguageRepositoryInterface;

class CertificateLanguageRepository extends BaseRepository implements CertificateLanguageRepositoryInterface
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

