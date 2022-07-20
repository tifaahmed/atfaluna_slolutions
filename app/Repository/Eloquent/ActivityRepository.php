<?php

namespace App\Repository\Eloquent;

use App\Models\Activity as ModelName;
use App\Repository\ActivityRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use URL;
use App\Models\Sub_user_certificate;

class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface
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
	public function filterPaginate($lesson_id,$itemsNumber)  {
		if($lesson_id ){
			$activities =  ModelName::where('lesson_id',$lesson_id);
			return $this->queryPaginate($activities,$itemsNumber,null,URL::full());

		}else{
			return $this->collection( $itemsNumber)  ;
		}
	}

	public function filterAll($lesson_id){
		if($lesson_id ){
			return ModelName::where('lesson_id',$lesson_id)->get();
		}else{
			return $this->all()  ;
		}	
	}
	// handleActivity
		public function handleActivity($sub_user_id,$activity_id,$percentage)  {

			$sub_user =   Auth::user()->sub_user()->find($sub_user_id);

			$activity		=  $this			->findById($activity_id) ;
			$lesson   		= 	$activity		->lesson()->first(); 
			$sub_subject 	= 	$lesson			->subSubject()->first();
			$subject 		= 	$sub_subject	->subject()->first();
			$age_group 		=	$subject		->age_group()->first();

			$subject_certificate = $subject->certificate()->first();
			$age_group_certificate = $age_group->certificate()->first();


			// calculate lesson point from percentage to number ( 00.0% to 0 )
			// run 1 F..
			$activity_points = $this->calculateFromPercentageToPoints($activity->points,$percentage); 

			$sub_user_activity =   $sub_user->subUserActivity()->where('activity_id',$activity_id)->withPivot('points')->first();
			
			if ($activity_points > 0) {
				// if first time 
				if ( !$sub_user_activity ) {
					// add row in subUserActivities table // attach & register points
					// run 1 F..
					$this->attachRegisterActivitie($sub_user,$activity_id,$activity_points);
	
					// gave the child (Activity points) in sub_users table 
					$this->gaveChildPoints($sub_user,$activity_points);
	
					// add row in subUserCertificates table // attach & register points (activity)
					$subject_certificate ? $this->attachRegisterCertificate($sub_user,$activity_points,$subject_certificate->id) : null;
					
					// add row in subUserCertificates table // attach & register points (activity)
					$age_group_certificate ? $this->attachRegisterCertificate($sub_user,$activity_points,$age_group_certificate->id) : null;
				}
				//  child get higher points 
				else if ($activity_points > $sub_user_activity->pivot->points){
					$difference_points = $activity_points - $sub_user_activity->pivot->points;

					// add row in subUserActivities table // attach & register points
					// run 1 F..
					$this->attachRegisterActivitie($sub_user,$activity_id,$activity_points);

					// gave the child (Activity points) in sub_users table 
					$this->gaveChildPoints($sub_user,$difference_points);
	
					// add row in subUserCertificates table // attach & register points (activity)
					$subject_certificate ? $this->attachRegisterCertificate($sub_user,$difference_points,$subject_certificate->id) : null;
					
					// add row in subUserCertificates table // attach & register points (activity)
					$age_group_certificate ? $this->attachRegisterCertificate($sub_user,$difference_points,$age_group_certificate->id) : null;
				}
			}

		}
		// run one time calculate Points of activity 
		public function calculateFromPercentageToPoints($full_points,$percentage) {
			$one_persent = $full_points /100;
			return $one_persent* $percentage;
		}
		// run one time only when child watch single lesson 
		public function attachRegisterActivitie($sub_user,$activity_id,$points) : void{
			$sub_user->subUserActivity()->syncWithoutDetaching( [ $activity_id => ['points' =>  $points] ]);
		}
		// run one time when to get activity  points  
		public function gaveChildPoints($sub_user,$points) : void {
			$sub_user->update(['points' => $sub_user->points + $points]);
		} 
		// run three time when to get lesson  points & Sub Subject & Subject
		public function attachRegisterCertificate($sub_user,$points,$certificate_id)  : void{
			// i use model not conection to use boot on update
			//  boot to add next age group
			$sub_user_certificate = Sub_user_certificate::where('certificate_id',$certificate_id)
														->where('sub_user_id',$sub_user->id)
														->first();

			// if is exist or not add the conection with points
			if ($sub_user_certificate) {
				// add new point to the old point 
				$sub_user_certificate->update(['points' => $sub_user_certificate->points + $points]); 
			}else{
				// add only the new point
				$sub_user->subUserCertificate()->syncWithoutDetaching([$certificate_id => ['points' =>  $points]]);
			}
		}
	// handleActivity
	
}


