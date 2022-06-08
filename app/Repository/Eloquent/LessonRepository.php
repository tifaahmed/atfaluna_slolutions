<?php

namespace App\Repository\Eloquent;

use App\Models\Lesson as ModelName;
use App\Repository\LessonRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;

use \Illuminate\Database\Eloquent\Collection;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use URL;
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
	
	public function getActiveSubjectsFromChild($sub_user)  {
		$all_sub_user_age_group =  $sub_user->subUserAgeGroup()->get();
		if ($all_sub_user_age_group->count() ) {
			// active_subjects
			return $subjects = $sub_user->ActiveSubjectsFromActiveAgeGroup()->get();
		}else{
			return abort( Response::HTTP_NOT_FOUND , 'there is no age_group for this child');			
		}
	}

	public function getFilteredLessonsFromSubjects($subjects,$lesson_type_id,$hero_id)  {
		if ($subjects) {
			$result = new Collection() ;
			foreach ($subjects as $key => $value) {
				$lessons = $value->lessons();

				if($lesson_type_id){
					$lessons = $lessons->whereHas('lesson_type',function (Builder $query) use($lesson_type_id) {
						$query->where('id',$lesson_type_id);
					});
				}	
				if($hero_id){
					$lessons = $lessons->whereHas('herolesson',function (Builder $query) use($hero_id) {
						$query->where('hero_id',$hero_id);
					});
				}	

				$lessons = $lessons ->get();
				$result = $result->merge( $lessons );
			}
			return $result ;
		}else{
			return abort( Response::HTTP_NOT_FOUND , 'there is no active_subjects for this child');			
		}
	}

	public function filterAll($sub_user_id,$lesson_type_id,$hero_id)  
    {
		$subjects = null;
		$lessons = null;
		// check if child_id exist (or) return all lessons
		if($sub_user_id ){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id); // checked in middleware

			// check if child has any Age Group (or) return error message
			// get the active_subjects (get) from first active_age_group (first)
			$subjects = $this->getActiveSubjectsFromChild($sub_user)  ;

			// check if child has active subjects (or) return error message
			// get all lessons (get) from all active subjects (get)
			$lessons = $this->getFilteredLessonsFromSubjects($subjects,$lesson_type_id,$hero_id)  ;
			if ( $lessons ) {
				return $lessons ;
			}else{
				return abort( Response::HTTP_NOT_FOUND , 'there is no lessons');			
			}
		}
		else{
			return $this->all()  ;
		}
	}
	public function filterPaginate($sub_user_id,$lesson_type_id,$hero_id,$itemsNumber)  
    {
		$subjects = null;
		$lessons = null;
		// check if child_id exist (or) return all lessons
		if($sub_user_id){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id); // checked in middleware

			// check if child has any Age Group (or) return error message
			// get the active_subjects (get) from first active_age_group (first)
			$subjects = $this->getActiveSubjectsFromChild($sub_user)  ;

			// check if child has active subjects (or) return error message
			// get all lessons (get) from all active subjects (get)
			$lessons = $this->getFilteredLessonsFromSubjects($subjects,$lesson_type_id,$hero_id)  ;


			// check if lessons not bull then pagenate(or) return error message
			if ( $lessons ) {
				return $this->paginate($lessons,$itemsNumber,null,URL::full());
			}else{
				return abort( Response::HTTP_NOT_FOUND , 'there is no lessons');			
			}

		}
		else{
			return $this->collection( $itemsNumber)  ;
		}
    }
    public function paginate($items, $perPage = 10, $page = null, $baseUrl = null, $options = [])
	{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

		$items = $items instanceof Collection ? 
					$items : Collection::make($items);

		$lap = new LengthAwarePaginator($items->forPage($page, $perPage), 
						$items->count(),
						$perPage, $page, $options);

		if ($baseUrl) {
			$lap->setPath($baseUrl);
		}

		return $lap;
	}

	// handleLessson

		public function handleLessson($sub_user_id,$lesson_id,$received_lesson_points)  
		{
			$sub_user 	=   Auth::user()->sub_user()->find($sub_user_id);
			
			$lesson   		= 	$this			->findById($lesson_id); 
			$sub_subject 	= 	$lesson			->subSubject()->first();
			$subject 		= 	$sub_subject	->subject()->first();
			$age_group 		=	$subject		->age_group()->first();

			$subject_certificate = $subject->certificate()->first();
			$age_group_certificate = $age_group->certificate()->first();


			$subUserLesson =   $sub_user->subUserLesson()->where('lesson_id',$lesson_id)->first();

			// if subUser did not watch the lesson before
			if (!$subUserLesson) {

				// gave the child (lesson points) in sub_users table 
				// run 1 F..
				$this->gaveChildPoints($sub_user,$received_lesson_points);
				
				// add row in subUserCertificates table // attach & register points
				// run 1 F..
				$subject_certificate ? $this->attachRegisterCertificate($sub_user,$received_lesson_points,$subject_certificate->id) : null;
				
				// add row in subUserCertificates table // attach & register points
				// run 1 F..
				$age_group_certificate ? $this->attachRegisterCertificate($sub_user,$received_lesson_points,$age_group_certificate->id) : null;
				
				// add row in subUserLessons table // attach & register points
				// run 1 F..
				$this->attachRegisterLessson($sub_user,$lesson->id,$received_lesson_points);
				
				// if sub Subject Condition is true run  attachRegisterSubSubject F..  (add sub subject row with point & gave sub subject point to the child)
				// add the point in the subject & age_group Certification
				// run 4 F..
				$this->AttachRegisterSubSubjectCondition($sub_subject,$sub_user,$subject_certificate,$age_group_certificate);

				// if SubjectCondition is true run RegisterSubject F.. (register point of subject to the child   & gave subject point to the child)
				// add the point in the subject & age_group Certification
				// run 4 F..
				$this->RegisterSubjectCondition($subject,$sub_user,$subject_certificate,$age_group_certificate);

			}

		}
		public function AttachRegisterSubSubjectCondition($sub_subject,$sub_user,$subject_certificate,$age_group_certificate) {
			$sub_subject_lessons_ids = $sub_subject->lessons()->pluck('id');
			$sub_subject_lessons_numbers = $sub_subject_lessons_ids->count();
			$sub_subject_lessons_sub_user_number 	=   $sub_user->subUserLesson()->whereIn('lesson_id',$sub_subject_lessons_ids)->count();
			if ($sub_subject_lessons_sub_user_number == $sub_subject_lessons_numbers) {
				$this->gaveChildPoints($sub_user,$sub_subject->points);// gave the child (sub_subject points) in sub_users table 
				$this->attachRegisterSubSubject($sub_user,$sub_subject->id,$sub_subject->points);// add row in sub_user_sub_subjects table // attach & register points
				$this->attachRegisterCertificate($sub_user,$sub_subject->points,$subject_certificate->id);// add row in subUserCertificates table // attach & register points
				$this->attachRegisterCertificate($sub_user,$sub_subject->points,$age_group_certificate->id);// add row in subUserCertificates table // attach & register points
			}
		}

		public function RegisterSubjectCondition($subject,$sub_user,$subject_certificate,$age_group_certificate) {
			$subject_sub_subject_ids = $subject->sub_subjects()->pluck('id');
			$subject_sub_subjects_numbers = $subject_sub_subject_ids->count();
			$subject_sub_subjects_sub_user_number 	=   $sub_user->subUserSubSubject()->whereIn('sub_subject_id',$subject_sub_subject_ids)->count();
			if ($subject_sub_subjects_sub_user_number == $subject_sub_subjects_numbers) {
				$this->gaveChildPoints($sub_user,$subject->points);// gave the child (subject points) in sub_users table 
				$this->RegisterSubject($sub_user,$subject->id,$subject->points);// register points only

				// add row in subUserCertificates table // attach & register points
				$subject_certificate ? $this->attachRegisterCertificate($sub_user,$subject->points,$subject_certificate->id) : null;
				// add row in subUserCertificates table // attach & register points
				$age_group_certificate ? $this->attachRegisterCertificate($sub_user,$subject->points,$age_group_certificate->id) : null;
			}
		}

		public function gaveChildPoints($sub_user,$points) {
			$sub_user->update(['points' => $sub_user->points + $points]);
		} 
		public function attachRegisterLessson($sub_user,$lesson_id,$points){
			$sub_user->subUserLesson()->syncWithoutDetaching( [ $lesson_id => ['points' =>  $points] ]);
			// $sub_user_lesson_model = $sub_user->subUserLessonModel()->where('lesson_id',$lesson_id)->first();
			// $sub_user_lesson_model->update(['points' =>  $points]);
		}
		public function attachRegisterCertificate($sub_user,$points,$certificate_id)  {
			$sub_user->subUserCertificate()->syncWithoutDetaching($certificate_id);
			$sub_user_certificate_model= $sub_user->subUserCertificateModel()->where('certificate_id',$certificate_id)->first();
			$sub_user_certificate_model->update(['points' => $sub_user_certificate_model->points + $points  ]);
		}

		public function attachRegisterSubSubject($sub_user,$sub_subject_id,$points){
			$sub_user->subUserSubSubject()->syncWithoutDetaching([$sub_subject_id => ['points' =>  $points]]);
			// $sub_user_sub_subject_model = $sub_user->subUserSubSubjectModel()->where('sub_subject_id',$sub_subject_id)->first();
			// $sub_user_sub_subject_model->update(['points' =>  $points]);
		}

		public function RegisterSubject($sub_user,$subject_id,$points){
			$sub_user_subject_model = $sub_user->subUserSubjectModel()->where('subject_id',$subject_id)->first();
			$sub_user_subject_model->update(['points' =>  $points]);
		}

		
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
				return $result->skills()->sync($skill_ids);	
			}
		}
	}