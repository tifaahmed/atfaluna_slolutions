<?php

namespace App\Repository;

interface PlayTimeRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id)  ;
	public function filterPaginate($sub_user_id,$per_page) ; 
	public function attatchByArray($array) ; 

}
