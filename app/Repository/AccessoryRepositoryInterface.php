<?php

namespace App\Repository;

interface AccessoryRepositoryInterface extends EloquentRepositoryInterface{
	public function attachActivities($activity_ids,$accessory_id)  ;
	public function attachLessons($lesson_ids,$accessory_id)  ;
	public function attachSkins($skin_ids,$accessory_id)  ;
	public function filterAll($gender)  ;
	public function filterPaginate($gender,int $itemsNumber)  ;
}
