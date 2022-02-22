<?php

namespace App\Repository\Eloquent\RolePermissionRepository;

use App\Models\Permission;
use App\Repository\RolePermissionInterface\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository  constructor
	 * @param  Model $model
	 */
	public function __construct(Permission $model)
	{
		$this->model =  $model;
	}

}

