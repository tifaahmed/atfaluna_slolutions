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
		public function handleActivity($sub_user_id,$activity_id,$percentage,$game_data)  {

			$sub_user =   Auth::user()->sub_user()->find($sub_user_id);

			$activity		=   $this			->findById($activity_id) ;
			$lesson   		= 	$activity		->lesson()->first(); 
			$sub_subject 	= 	$lesson			->subSubject()->first();
			$subject 		= 	$sub_subject	->subject()->first();
			$age_group 		=	$subject		->age_group()->first();

			$subject_certificate = $subject->certificate()->first();
			$subject_certificate->subUserCertificate()->syncWithoutDetaching($sub_user_id);

			$age_group_certificate = $age_group->certificate()->first();
			$age_group_certificate->subUserCertificate()->syncWithoutDetaching($sub_user_id);

			$sub_user_activity 				=   $activity->subUserActivity('sub_user_id',$sub_user_id)
			->withPivot('points')->first();

			$subject_subUser_certificate 	= $subject->certificate()->first()
			->subUserCertificate('sub_user_id',$sub_user_id)
			->withPivot('points')->first();

			$age_group_subUser_certificate 	= $age_group->certificate()->first()
			->subUserCertificate('sub_user_id',$sub_user_id)
			->withPivot('points')->first();

			// calculate lesson point from percentage to number ( 00.0% to 0 )
			// run 1 F..
			$activity_points = $this->calculateFromPercentageToPoints($activity->points,$percentage); 

			
			// if first time 
			if ( !$sub_user_activity ) {
				$Register_activitie_points = $activity_points;
				$Register_subject_certificate_points = $subject_subUser_certificate->pivot->points + $activity_points;
				$Register_ageAroup_certificate_points = $age_group_subUser_certificate->pivot->points + $activity_points;
				$Register_childPoints_points = $sub_user->points + $activity_points;
			}
			//  child get higher points 
			else if ($activity_points > $sub_user_activity->pivot->points){
				$deffrence_activity_points = $activity_points - $sub_user_activity->pivot->points;

				$Register_activitie_points =  $sub_user_activity->pivot->points + $deffrence_activity_points; 
				$Register_subject_certificate_points = $subject_subUser_certificate->pivot->points + $deffrence_activity_points;
				$Register_ageAroup_certificate_points = $age_group_subUser_certificate->pivot->points + $deffrence_activity_points;
				$Register_childPoints_points = $sub_user->points + $deffrence_activity_points;
			}
			//  child get less points 
			// result do not get any points
			else if ($activity_points <= $sub_user_activity->pivot->points){
				$Register_activitie_points = $sub_user_activity->pivot->points ;
				$Register_subject_certificate_points = $subject_subUser_certificate->pivot->points ;
				$Register_ageAroup_certificate_points = $age_group_subUser_certificate->pivot->points;
				$Register_childPoints_points = $sub_user->points ;
			}

			// add row in subUserActivities table // attach & register points
			// run 1 F..
			$this->attachRegisterActivity($sub_user,$activity_id,$Register_activitie_points,$game_data);

			// gave the child (Activity points) in sub_users table 
			$this->gaveChildPoints($sub_user,$Register_childPoints_points);

			// add row in subUserCertificates table // attach & register points (activity)
			$this->attachRegisterCertificate($sub_user,$Register_subject_certificate_points,$subject_certificate->id);
			
			// add row in subUserCertificates table // attach & register points (activity)
			$this->attachRegisterCertificate($sub_user,$Register_ageAroup_certificate_points,$age_group_certificate->id);
		
					
		}
		// run one time calculate Points of activity 
		public function calculateFromPercentageToPoints($full_points,$percentage) {
			$one_persent = $full_points /100;
			return $one_persent * $percentage;
		}
		// run one time only when child watch single lesson 
		public function attachRegisterActivity($sub_user,$activity_id,$points,$game_data) : void{
			$sub_user->subUserActivity()->syncWithoutDetaching( [ $activity_id => ['points' =>  $points,'game_data' =>  $game_data] ]);
		}
		// run one time when to get activity  points  
		public function gaveChildPoints($sub_user,$points) : void {
			$sub_user->update(['points' =>  $points]);
		} 
		// run three time when to get lesson  points & Sub Subject & Subject
		public function attachRegisterCertificate($sub_user,$points,$certificate_id)  : void{
			// i use model not conection to use boot on update
			//  boot to add next age group
			$sub_user_certificate = Sub_user_certificate::where('certificate_id',$certificate_id)
														->where('sub_user_id',$sub_user->id)
														->first();

			// if is exist or not add the conection with points
			// add new point to the old point 
			$sub_user_certificate->update(['points' => $points]); 
		}
	// handleActivity
	
}


