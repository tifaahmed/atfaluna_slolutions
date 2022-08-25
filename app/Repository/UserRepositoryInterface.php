<?php

namespace App\Repository;

interface UserRepositoryInterface extends EloquentRepositoryInterface{


    public function attachRole($role_id,$id);


}
