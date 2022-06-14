<?php

namespace App\Repository\Eloquent;

use App\Models\Skill as ModelName;
use App\Repository\SkillRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SkillRepository extends BaseRepository implements SkillRepositoryInterface
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
	public function skillIdsByAgeGroup($age_group) {
		$all_skill_related_to_age_group = [];

		$subjects = $age_group->subjects()->get();

		foreach ($subjects as $subject) {
			$subject_skill_ids = $subject->skills()->get()->pluck('id')->toArray();
			$all_skill_related_to_age_group = array_merge($subject_skill_ids, $all_skill_related_to_age_group);
			
			foreach ($subject->sub_subjects as $sub_subject) {
				$sub_subject_skill_ids = $sub_subject->skills()->get()->pluck('id')->toArray();
				$all_skill_related_to_age_group = array_merge($sub_subject_skill_ids, $all_skill_related_to_age_group);

				foreach ($sub_subject->lessons as $lesson) {
					$lesson_skill_ids = $lesson->skills()->get()->pluck('id')->toArray();
					$all_skill_related_to_age_group = array_merge($lesson_skill_ids, $all_skill_related_to_age_group);
				}
			}
		}
		return $all_skill_related_to_age_group;
	} 


	public function filterAll($sub_user_id)  
    {
		if ($sub_user_id) {
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			$age_group =  $sub_user->ActiveAgeGroup()->first();
			$all_skill_related_to_age_group = $this->skillIdsByAgeGroup($age_group) ; 
			return ModelName::whereIn('id',$all_skill_related_to_age_group)->get();
		}else{
			return $this->all()  ;
		} 
	}
	public function filterPaginate($sub_user_id,$itemsNumber)  
    {
		if ($sub_user_id) {
			$sub_user = Auth::user()->sub_user()->find($sub_user_id);
			$age_group =  $sub_user->ActiveAgeGroup()->first();
			$all_skill_related_to_age_group = $this->skillIdsByAgeGroup($age_group) ; 
			return ModelName::whereIn('id',$all_skill_related_to_age_group)->paginate($itemsNumber);
		}else{
			return $this->collection( $itemsNumber)  ;
		} 
	}


	
}

