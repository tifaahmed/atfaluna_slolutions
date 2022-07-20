<?php

namespace App\Repository;

interface FriendRepositoryInterface extends EloquentRepositoryInterface{
    public function filterAll($sub_user_id) ;
    public function filterPaginate($sub_user_id,int $itemsNumber)  ;
}
