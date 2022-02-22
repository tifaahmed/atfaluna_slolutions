<?php

namespace App\Repository\RolePermissionInterface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
	/**
	* Get all models
	* 
	* @param  array  $columns
	* @param  array  $relations
	* @return Collection	
	*/
	public function all(array $columns = ['*'], array $relations = []): Collection ;

	/**
	 * @param  int  $modelId
	 * @return  pagination 
	 */
	public function collection(int $modelId)  ;

		/**
	 * @param  int  $modelId
	 * @return  pagination trash
	 */
	public function collection_trash(int $modelId)  ;


	/**
	 * get all trashed models
	 * @return  Collection
	 */
	public function allTrashed(): Collection;

	/**
	 * find model by id
	 * @param  int $modelId
	 * @param  array $columns
	 * @param  array $relations
	 * @param  array $appends
	 * @return Model
	 */
	public function findById(
		int $modelId,
		array $columns   = ['*'],
		array $relations = [],
		array $appends   = [],
	): ?model;

	/**
	 * find trashed model by id
	 * @param  int $modelId
	 * @return Model
	 */
	public function findTrashedById(int $modelId): ?model;

	/**
	 * find trashed model by id
	 * @param  int $modelId
	 * @return Model
	 */
	public function findOnlyTrashedById(int $modelId): ?model;

	/**
	 * create a model
	 * @param  array $payload
	 * @return Model
	 */
	public function create(array $payload): ?model;

	/**
	* update  existing model
	* @param  int $modelId
	* @param  array $payload
	* @return bool
	*/
	public function update(int $modelId , array $payload): bool;

	/**
	* delete model by id
	* @param  int $modelId
	* @return bool
	*/
	public function deleteById(int $modelId): bool;

	/**
	 * @param  int  	$modelId
	 * @return string  	$relation_coulmn
	 */
	public function deleteByRelation( $relation_coulmn , int $modelId): bool;


	/**
	* restor model by id
	* @param  int $modelId
	* @return bool
	*/
	public function restorById(int $modelId): bool;

	/**
	* premanently delete model by id
	* @param  int $modelId
	* @return bool
	*/
	public function PremanentlyDeleteById(int $modelId): bool;
	
}
