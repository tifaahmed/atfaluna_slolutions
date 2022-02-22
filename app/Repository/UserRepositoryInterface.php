<?php

namespace App\Repository;

interface UserRepositoryInterface extends EloquentRepositoryInterface{


	public function HelperDelete($disk,$url)  ;

	public function HelperStorage($disk ,$path , $file  ) : string;

}
