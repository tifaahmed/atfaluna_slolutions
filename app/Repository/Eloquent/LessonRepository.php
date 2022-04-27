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

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
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
				$lesssons = $value->lesssons();

				if($lesson_type_id){
					$lesssons = $lesssons->whereHas('lesson_type',function (Builder $query) use($lesson_type_id) {
						$query->where('id',$lesson_type_id);
					});
				}	
				if($hero_id){
					$lesssons = $lesssons->whereHas('herolesson',function (Builder $query) use($hero_id) {
						$query->where('hero_id',$hero_id);
					});
				}	

				$lesssons = $lesssons ->get();
				$result = $result->merge( $lesssons );
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

	public function attachQuiz($quiz_ids,$id)  
    {
		if($quiz_ids){
			$lesson = $this->findById($id); 

			$lesson_quizzes =  $lesson->quiz()->get();
			$lesson_quizzes->each(function($quiz) {
				$quiz->update(['quizable_id'=>null,'quizable_type'=>null]); 
			});

			$quizs =  Quiz::findMany($quiz_ids);
			foreach ($quizs as $quiz_key => $quiz) {
				$quiz->update(['quizable_id'=>$id,'quizable_type'=>$lesson::class]); 
			}


		}
	}
}

