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
			// $result->subUserAccessory()->detach();
			$result->subUserAccessory()->syncWithoutDetaching($accessory_ids);
		}
	}
    public function attachAvatars($avatar_ids,$id)
	{
		if($avatar_ids){
			$result = $this->findById($id); 
			// $result->subUserAvatar()->detach();
			$result->subUserAvatar()->syncWithoutDetaching($avatar_ids);
	
		}
	}
	
	public function attachCertificates($certificate_ids,$id)
	{
		if($certificate_ids){
			$result = $this->findById($id); 
			$result->subUserCertificate()->syncWithoutDetaching($certificate_ids);
	
		}
	}

	public function attachSubjects($subject_ids,$id)
	{
		if($subject_ids){
			$result = $this->findById($id); 
			$result->subUserSubject()->syncWithoutDetaching($subject_ids);
	
		}
	}

	public function attachAgeGroups($age_group_ids,$id)
	{
		if($age_group_ids){
			$result = $this->findById($id); 
			$result->subUserAgeGroup()->syncWithoutDetaching($age_group_ids);
	
		}
	}
}

