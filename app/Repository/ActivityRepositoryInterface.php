<?php

namespace App\Repository;

interface ActivityRepositoryInterface extends EloquentRepositoryInterface{
    public function filterPaginate($lesson_id,int $itemsNumber)  ;
	public function filterAll($lesson_id)  ;
}
