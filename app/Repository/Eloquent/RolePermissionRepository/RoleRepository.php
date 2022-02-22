<?php

namespace App\Repository\Eloquent\RolePermissionRepository;

use App\Models\Role;
use App\Repository\RolePermissionInterface\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository  constructor
	 * @param  Model $model
	 */
	public function __construct(Role $model)
	{
		$this->model =  $model;
	}

}

