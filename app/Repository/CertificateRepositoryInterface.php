<?php

namespace App\Repository;

interface CertificateRepositoryInterface extends EloquentRepositoryInterface{
	public function filterAll($sub_user_id,$age_group_id,$type)  ;
    public function filterPaginate($sub_user_id,$age_group_id,$type,int $itemsNumber)  ;

}
