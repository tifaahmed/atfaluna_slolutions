<?php

namespace App\Repository\Eloquent;

use App\Models\Certificate as ModelName;
use App\Repository\CertificateRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Subject;             
use App\Models\Age_group;          

class CertificateRepository extends BaseRepository implements CertificateRepositoryInterface
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
	public function filter($sub_user_id,$age_group_id,$type)  {
		$model =   $this->model;
		if($sub_user_id ){
			$model = $model->whereHas('subUserCertificate', function (Builder $query) use($sub_user_id) {
				$query->where('sub_user_id',$sub_user_id);
			});
		}

		if($sub_user_id ){
			$model = $model->whereHas('subUserCertificate', function (Builder $query) use($sub_user_id) {
				$query->where('sub_user_id',$sub_user_id);
			});
		}

		if ($type == 'age_group') {
			$model = $model->whereHasMorph(
				'certificatable',
				Age_group::class,
				function (Builder $query)  use($age_group_id) {
					if($age_group_id ){
						$query->where('certificatable_id' , $age_group_id );
					}
				}
			);
		}
		if ($type == 'subject') {
			$model = $model->whereHasMorph(
				'certificatable',
				Subject::class,
				function (Builder $query)  use($age_group_id) {
					if($age_group_id ){
						$subject_ids  = Subject::where('age_group_id',$age_group_id)->get()->pluck('id')->toArray();
						$query->whereIn('certificatable_id' , $subject_ids );
					}
				}
			);
		}
		return 	$model;
	}

	
	public function filterAll($sub_user_id,$age_group_id,$type)  
    {
		$model = $this->filter($sub_user_id,$age_group_id,$type)  ;
		return $model->get()  ;
	}
	public function filterPaginate($sub_user_id,$age_group_id,$type,int $itemsNumber)   
    {
		$model = $this->filter($sub_user_id,$age_group_id,$type)  ;
		return $model->paginate($itemsNumber)->appends(request()->query());
	}
}


