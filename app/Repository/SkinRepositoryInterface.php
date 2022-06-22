<?php

namespace App\Repository;

interface SkinRepositoryInterface extends EloquentRepositoryInterface{
	public function filterPaginate($free,$sub_user_id,int $itemsNumber)  ;
	public function filterAll($free,$sub_user_id)  ;
    public function OnlyOneOriginal($skin_id);

}

