<?php

namespace App\Repository\Eloquent;

use App\Models\Sub_user as ModelName;
use App\Repository\SubUserRepositoryInterface;
use App\Models\Age ;
use Illuminate\Support\Facades\Auth;
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
//Accessory
    public function attachAccessories($accessory_ids,$id)
	{
		if($accessory_ids){
			$result = $this->findById($id); 
			$result->subUserAccessory()->sync($accessory_ids);
		}
	}
//Achievement
	public function attachAchievements($achievement_ids,$id)
	{
		if($achievement_ids){
			$result = $this->findById($id); 
			$result->subUserAchievement()->sync($achievement_ids);
		}
	}
//Avatar
    public function attachAvatars($avatar_ids,$id)
	{
		if($avatar_ids){
			$result = $this->findById($id); 
			$result->subUserAvatar()->sync($avatar_ids);
		}
	}
//Certificate
	public function attachCertificates($certificate_ids,$id)
	{
		if($certificate_ids){
			$result = Auth::user()->sub_user()->find($id); 
			$result->subUserCertificate()->sync($certificate_ids);
		}
	}
//Subject
	public function attachSubjects($subject_ids,$id)
	{
		if($subject_ids){
			$sub_user =   Auth::user()->sub_user()->find($id);
			$sub_user->subUserSubject()->sync($subject_ids);
		}
	}
//Quiz
	public function attachQuizs($quiz_ids,$id)
	{
		if($quiz_ids){
			$sub_user =   Auth::user()->sub_user()->find($id);
			$sub_user->subUserQuiz()->sync($quiz_ids);
		}
	}
//Lesson
	public function attachLessons($lesson_ids,$id)
	{
		if($lesson_ids){
			$sub_user =   Auth::user()->sub_user()->find($id);
			$sub_user->subUserLesson()->sync($lesson_ids);
		}
	}

	// $age_group_ids : array of age group id
	// $id  : integer sub user id
	// action :  attach age group to sub user
	// return nothing
	public function attachAgeGroups($age_group_ids,$id)
	{
		if($age_group_ids){
			$sub_user =   Auth::user()->sub_user()->find($id);
			$sub_user->subUserAgeGroup()->syncWithoutDetaching($age_group_ids);
		}
	}
	// $age_number : age_number exist in ages table
	// $id  : integer sub user id
	// action : attach one age group and only one can be active
	// return age_group model
	public function attachAgeGroupByAge($age_number,$id)
	{
		if ($age_number) {
			$age = Age::where('age',$age_number)->first();
			$age_group =  $age->age_group()->first();
			$this->attachAgeGroups($age_group->id,$id);
			$this->UnactiveAllAgeGroups($id);	
			$this->activeAgeGroup($age_group->id,$id);
		}
	}
	public function UnactiveAllAgeGroups($id)
	{
		if ($id) {
			$sub_user =   Auth::user()->sub_user()->find($id);
			$sub_user->subUserAgeGroup()->update(['active'=> 0]);
		}
	}
	public function activeAgeGroup($age_group_id,$id)
	{
		if ($age_group_id) {
			$sub_user =   Auth::user()->sub_user()->find($id);
			$sub_user->subUserAgeGroup()->where('age_group_id',$age_group_id)->update(['active'=> 1]);		
		}
	}

}

