<?php

namespace App\Repository\Eloquent\RolePermissionRepository;

use App\Models\RoleHasPermission;
use App\Repository\RolePermissionInterface\RoleHasPermissionRepositoryInterface;

class RoleHasPermissionRepository extends BaseRepository implements RoleHasPermissionRepositoryInterface
{

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository  constructor
	 * @param  Model $model
	 */
	public function __construct(RoleHasPermission $model)
	{
		$this->model =  $model;
	}

}

