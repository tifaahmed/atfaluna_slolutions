<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_user as ModelName;
use App\Repository\SubUserRepositoryInterface;

class SubUserRepository extends BaseRepository implements SubUserRepositoryInterface
{

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * BaseRepository  constructor
	 * @param  Model $model
	 */
	public function __construct(ModelName $model)
	{
		$this->model =  $model;
	}

    public function attachAccessories($accessory_ids,$id)
	{
		if($accessory_ids){
			$result = $this->findById($id); 
			$result->subUserAccessory()->detach();
			$result->subUserAccessory()->syncWithoutDetaching($accessory_ids);
		}
	}
    public function attachAvatars($avatar_ids,$id)
	{
		if($avatar_ids){
			$result = $this->findById($id); 
			$result->subUserAvatar()->detach();
			$result->subUserAvatar()->syncWithoutDetaching($avatar_ids);
	
		}
	}
	

	
}

