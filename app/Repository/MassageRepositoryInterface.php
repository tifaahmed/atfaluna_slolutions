<?php

namespace App\Repository;

interface MassageRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($conversation_id)  ;
	public function filterPaginate($conversation_id,int $itemsNumber)  ;

}
