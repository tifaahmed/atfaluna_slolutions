<?php

namespace App\Repository;

interface UserRepositoryInterface extends EloquentRepositoryInterface{


    public function attachRole($UserRoles,$id);


}
