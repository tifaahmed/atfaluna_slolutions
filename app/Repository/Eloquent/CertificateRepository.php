<?php

namespace App\Repository\Eloquent;

use App\Models\Certificate as ModelName;
use App\Repository\CertificateRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CertificateRepository extends BaseRepository implements CertificateRepositoryInterface
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

