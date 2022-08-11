<?php

namespace App\Repository\Eloquent;

use App\Models\Lesson as ModelName;
use App\Repository\LessonRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\Sub_user_certificate;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Response ;

class LessonRepository extends BaseRepository  implements LessonRepositoryInterface
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
	public function filter($sub_user_id,$lesson_type_id,$hero_id,$seen,$age_group_id)  {
		$model =   $this->model;
		if($seen){
			$model = $model->whereHas('subUserLesson', function (Builder $query) use($sub_user_id) {
				if($sub_user_id){
					$query->where('sub_user_id',$sub_user_id);
				}
			});
		}
		if($age_group_id){
			$model = $model->whereHas('subSubject', function (Builder $sub_subject_query) use($age_group_id) {
				$sub_subject_query->whereHas('subject', function (Builder $subject_query) use($age_group_id) {
					$subject_query->whereHas('age_group', function (Builder $age_group_query) use($age_group_id) {
						$age_group_query->where('age_group_id',$age_group_id);
					});
				});
			});
		}
		if($hero_id){
			$model = $model->whereHas('herolesson',function (Builder $query) use($hero_id) {
				$query->where('hero_id',$hero_id);
			});
		}
		if($lesson_type_id){
			$model = $model->whereHas('lesson_type',function (Builder $query) use($lesson_type_id) {
				$query->where('id',$lesson_type_id);
			});
		}
		return 	$model;
	}



	public function filterAll($sub_user_id,$lesson_type_id,$hero_id,$seen,$age_group_id)  
    {
		$model = $this->filter($sub_user_id,$lesson_type_id,$hero_id,$seen,$age_group_id)  ;
		return $model->get();
	}
	public function filterPaginate($sub_user_id,$lesson_type_id,$hero_id,$seen,$age_group_id,$itemsNumber)  
    {
		$model = $this->filter($sub_user_id,$lesson_type_id,$hero_id,$seen,$age_group_id)  ;
		return $model->paginate($itemsNumber)->appends(request()->query());
    }


	// handleLessson
		public function handleLessson($sub_user_id,$lesson_id,$percentage,$game_data)  
		{
			$sub_user 	=   Auth::user()->sub_user()->find($sub_user_id);
			
			$lesson   		= 	$this			->findById($lesson_id); 
			$sub_subject 	= 	$lesson			->subSubject()->first();
			$subject 		= 	$sub_subject	->subject()->first();
			$age_group 		=	$subject		->age_group()->first();

			$subject_certificate = $subject->certificate()->first();
			$subject_certificate->subUserCertificate()->syncWithoutDetaching($sub_user_id);

			$age_group_certificate = $age_group->certificate()->first();
			$age_group_certificate->subUserCertificate()->syncWithoutDetaching($sub_user_id);

			$subject_subUser_certificate 	= $subject->certificate()->first()
			->subUserCertificate('sub_user_id',$sub_user_id)
			->withPivot('points')->first();

			$age_group_subUser_certificate 	= $age_group->certificate()->first()
			->subUserCertificate('sub_user_id',$sub_user_id)
			->withPivot('points')->first();


			// calculate lesson point from percentage to number ( 00.0% to 0 )
			$lesson_points = $this->calculateFromPercentageToPoints($lesson->points,$percentage); 

			$sub_user_lesson =   $sub_user->subUserLesson()->where('lesson_id',$lesson_id)->first();

			// if ($lesson_points > 0) {


			// if first time 
			if ( !$sub_user_lesson ) {
				$Register_lesson_points = $lesson_points; // subUserLessons table
				$Register_subject_certificate_points = $subject_subUser_certificate->pivot->points + $lesson_points;
				$Register_ageAroup_certificate_points = $age_group_subUser_certificate->pivot->points + $lesson_points;
				$Register_childPoints_points = $sub_user->points + $lesson_points;
			}
			//  child get higher points 
			else if ($lesson_points > $sub_user_lesson->pivot->points){
				$deffrence_lesson_points = $lesson_points - $sub_user_lesson->pivot->points;

				$Register_lesson_points =  $sub_user_lesson->pivot->points + $deffrence_lesson_points;  // subUserLessons table
				$Register_subject_certificate_points = $subject_subUser_certificate->pivot->points + $deffrence_lesson_points;
				$Register_ageAroup_certificate_points = $age_group_subUser_certificate->pivot->points + $deffrence_lesson_points;
				$Register_childPoints_points = $sub_user->points + $deffrence_lesson_points;
			}
			//  child get less points 
			// result do not get any points
			else if ($lesson_points <= $sub_user_lesson->pivot->points){
				$Register_lesson_points = $sub_user_lesson->pivot->points ; // subUserLessons table
				$Register_subject_certificate_points = $subject_subUser_certificate->pivot->points ;
				$Register_ageAroup_certificate_points = $age_group_subUser_certificate->pivot->points;
				$Register_childPoints_points = $sub_user->points ;
			}



			// gave the child (lesson points) in sub_users table 
			// run 1 F..
			$this->gaveChildPoints($sub_user,$Register_childPoints_points);
			
			// add row in subUserCertificates table // attach & register points (subject)
			// run 1 F..
			$this->attachRegisterCertificate($sub_user,$Register_subject_certificate_points,$subject_certificate->id);
			
			// add row in subUserCertificates table // attach & register points (age_group)
			// run 1 F..
			$this->attachRegisterCertificate($sub_user,$Register_ageAroup_certificate_points,$age_group_certificate->id) ;
			
			// add row in subUserLessons table // attach & register points
			// run 1 F..
			$this->attachRegisterLessson($sub_user,$lesson->id,$Register_lesson_points,$game_data);
			
			// if sub Subject Condition is true run  attachRegisterSubSubject F..  (add sub subject row with point & gave sub subject point to the child)
			// add the point in the subject & age_group Certification
			// run 4 F..
			$this->AttachRegisterSubSubjectCondition($sub_subject,$sub_user,$subject_certificate,$age_group_certificate);

			// if SubjectCondition is true run RegisterSubject F.. (register point of subject to the child   & gave subject point to the child)
			// add the point in the subject & age_group Certification
			// run 4 F..
			$this->RegisterSubjectCondition($subject,$sub_user,$subject_certificate,$age_group_certificate);


		}

		// run one time calculate Points of lesson 
		public function calculateFromPercentageToPoints($full_points,$percentage) {
			$one_persent = $full_points /100;
            return $one_persent* $percentage;
		}

		public function AttachRegisterSubSubjectCondition($sub_subject,$sub_user,$subject_certificate,$age_group_certificate) {
			$sub_subject_lessons_ids = $sub_subject->lessons()->pluck('id');
			$sub_subject_lessons_numbers = $sub_subject_lessons_ids->count();
			$sub_subject_lessons_sub_user_number 	=   $sub_user->subUserLesson()->whereIn('lesson_id',$sub_subject_lessons_ids)->count();
			if ($sub_subject_lessons_sub_user_number == $sub_subject_lessons_numbers) {
				// gave the child sub supject points and register what he tack 
					// gave the child (sub_subject points) in sub_users table  
					$this->gaveChildPoints($sub_user,$sub_subject->points);
					// add row in sub_user_sub_subjects table // attach & register points
					$this->attachRegisterSubSubject($sub_user,$sub_subject->id,$sub_subject->points);
					
				// register Sub Subject points in two Certificates (subject & age_group)
					// add row in subUserCertificates table // attach & register points (subject)
					$subject_certificate ? $this->attachRegisterCertificate($sub_user,$sub_subject->points,$subject_certificate->id) : null;
					// add row in subUserCertificates table // attach & register points (age_group)
					$age_group_certificate ? $this->attachRegisterCertificate($sub_user,$sub_subject->points,$age_group_certificate->id) : null;
			}
		}

		public function RegisterSubjectCondition($subject,$sub_user,$subject_certificate,$age_group_certificate) : void{
			$subject_sub_subject_ids = $subject->sub_subjects()->pluck('id');
			$subject_sub_subjects_numbers = $subject_sub_subject_ids->count();
			$subject_sub_subjects_sub_user_number 	=   $sub_user->subUserSubSubject()->whereIn('sub_subject_id',$subject_sub_subject_ids)->count();
			if ($subject_sub_subjects_sub_user_number == $subject_sub_subjects_numbers) {
				// gave the child supject points and register what he tack  
					// gave the child (subject points) in sub_users table 
					$this->gaveChildPoints($sub_user,$subject->points);
					// register points only
					$this->RegisterSubject($sub_user,$subject->id,$subject->points);

				// register subject points in two Certificates (subject & age_group)
					// add row in subUserCertificates table // attach & register points
					$subject_certificate ? $this->attachRegisterCertificate($sub_user,$subject->points,$subject_certificate->id) : null;
					// add row in subUserCertificates table // attach & register points
					$age_group_certificate ? $this->attachRegisterCertificate($sub_user,$subject->points,$age_group_certificate->id) : null;
			}
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
				$sub_user_certificate->update(['points' =>  $points]); 
			}else{
				// add only the new point
				$sub_user->subUserCertificate()->syncWithoutDetaching([$certificate_id => ['points' =>  $points]]);
			}
		}

		// run three time when to get lesson  points & Sub Subject & Subject
		public function gaveChildPoints($sub_user,$points) : void {
			$sub_user->update(['points' => $points]);
		} 
		// run one time only when child watch single lesson 
		public function attachRegisterLessson($sub_user,$lesson_id,$points,$game_data) : void{
			$sub_user->subUserLesson()->syncWithoutDetaching( [ $lesson_id => ['points' =>  $points,'game_data' =>  $game_data] ]);
		}
		// run one time only when child watch all lesson of the Sub Subject
		public function attachRegisterSubSubject($sub_user,$sub_subject_id,$points){
			$sub_user->subUserSubSubject()->syncWithoutDetaching([$sub_subject_id => ['points' =>  $points]]);
		}
		// run one time only when child watch all Sub Subject of the Subject
		public function RegisterSubject($sub_user,$subject_id,$points){
			$sub_user->subUserSubject()->syncWithoutDetaching([$subject_id => ['points' =>  $points]]);
		}

	// handleLessson
	
		public function attachQuiz($quiz_ids,$id)  
		{
			if($quiz_ids){
				$lesson = $this->findById($id); 
				
				$lesson_quizzes =  $lesson->quiz()->get();
				foreach ($lesson_quizzes as $key => $value) {
					$value->quizable()->dissociate()->save();
				}
				foreach ($quiz_ids as $quiz_key => $quiz_id) {
					$quiz =  Quiz::find($quiz_id);
					$quiz->quizable()->associate($lesson)->save(); 
				}
			}
		}
		public function attachSkills($skill_ids,$id)
		{
			if($skill_ids){
				$result = $this->findById($id); 
				$result->skills()->sync($skill_ids);	
			}
		}
	}