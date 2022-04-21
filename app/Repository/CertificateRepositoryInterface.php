<?php

namespace App\Repository;

interface CertificateRepositoryInterface extends EloquentRepositoryInterface{
    public function filterPaginate($sub_user_id, int $itemsNumber)  ;
	public function filterAll($sub_user_id,) ;
}
