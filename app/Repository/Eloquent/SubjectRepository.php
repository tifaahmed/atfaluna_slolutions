<?php

namespace App\Repository\Eloquent;

use App\Models\Subject as ModelName;
use App\Repository\SubjectRepositoryInterface;
use App\Models\Quiz;             // morphedByMany
use Illuminate\Http\Response ;
use App\Models\Certificate;             // morphedByMany
use App\Models\Sub_user;             // morphedByMany

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
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
	public function filter($sub_user_id,$age_group_id)  {
		$model =   $this->model;

		if($sub_user_id){
			$model = $model->whereHas('subUserSubject', function (Builder $query) use($sub_user_id) {
				$query->where('sub_user_id',$sub_user_id)->where('active',1);
			});
		}

		if($age_group_id){
			$model = $model->where('age_group_id',$age_group_id);
		}

		return 	$model;
	}

	public function filterPaginate($sub_user_id,$age_group_id, int $itemsNumber)  
    {
		$model = $this->filter($sub_user_id,$age_group_id)  ;
		return $model->paginate($itemsNumber)->appends(request()->query());
    }
	public function filterAll($sub_user_id,$age_group_id)  
    {
		$model = $this->filter($sub_user_id,$age_group_id)  ;
		return $model->get();
	}

	public function attachQuiz($quiz_id,$id)  
    {
		if($quiz_id){
			$subject = $this->findById($id); 
			
			$subject_quizzes =  $subject->quiz()->get();
			foreach ($subject_quizzes as $key => $value) {
				$value->quizable()->dissociate()->save();
			}

			$quiz =  Quiz::find($quiz_id);
			$quiz->quizable()->associate($subject)->save();
		}
	}

	public function attachCertificate($certificate_id,$id)  
    {
		// if($certificate_id){
			$subject = $this->findById($id); 
			
			$subject_certificates =  $subject->certificate()->get();
			foreach ($subject_certificates as $key => $value) {
				$value->certificatable()->dissociate()->save();
			}

			$certificate =  Certificate::find($certificate_id);
			$certificate->certificatable()->associate($subject)->save();
		// }
	}

	public function attachSkills($skill_ids,$id)
	{
		if($skill_ids){
			$result = $this->findById($id); 
			return $result->skills()->sync($skill_ids);
		}
	}

	
}

