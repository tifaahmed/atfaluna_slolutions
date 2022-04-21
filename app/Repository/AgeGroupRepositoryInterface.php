<?php

namespace App\Repository;

interface AgeGroupRepositoryInterface extends EloquentRepositoryInterface{
	public function attachCertificate($certificate_id,$id)  ;

}
