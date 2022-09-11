<?php

namespace App\Repository;

interface SkinRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($original)  ;
	public function filterPaginate($original,int $itemsNumber)  ;
    public function OnlyOneOriginal($skin_id);

}

