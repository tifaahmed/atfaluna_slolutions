<?php

namespace App\Repository;

interface MassageImageRepositoryInterface extends EloquentRepositoryInterface{
	public function attachMassage($massage_id,$id)  ;

}
