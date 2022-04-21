<?php

namespace App\Repository\Eloquent;

use App\Models\Certificate as ModelName;
use App\Repository\CertificateRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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
	public function filterAll($sub_user_id)  
    {
		if($sub_user_id){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$result   		= $sub_user->Certificate()->get();
			return $result;
		}else{
			return $this->all()  ;
		}
	}
	public function filterPaginate($sub_user_id,$perPage) 
    {
		if($sub_user_id){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			$result   = $sub_user->Certificate();
			return $this->queryPaginate($result,$perPage);

		}else{
			return $this->collection( $perPage)  ;
		}
    }
}

