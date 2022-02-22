<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Storage;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository  constructor
	 * @param  Model $model
	 */
	public function __construct(User $model)
	{
		$this->model =  $model;
	}

	// * @param  string $disk
	// * @param  string $url
	// @return path of the file
	public function HelperDelete($disk,$url)  
    {
        if (Storage::disk($disk)->exists($url)) {
            Storage::disk($disk)->delete($url);
        }
    }


	// * @param  string $disk
	// * @param  string $path
	// * @param  file $file
	// @return string
	public function HelperStorage($disk ,$path , $file  ) : string
    {
        $result = Storage::disk($disk)->put($path,$file);
        return $result;
    }

	
}

