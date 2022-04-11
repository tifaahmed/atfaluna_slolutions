<?php

namespace App\Repository;

interface AboutUsRepositoryInterface extends EloquentRepositoryInterface{
	public function filterFirst($language)  ;

}
