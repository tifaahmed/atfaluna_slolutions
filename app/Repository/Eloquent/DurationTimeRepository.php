<?php

namespace App\Repository\Eloquent;

use App\Models\Duration_time as ModelName;
use App\Repository\DurationTimeRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
class DurationTimeRepository extends BaseRepository implements DurationTimeRepositoryInterface
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
	public function filter($type,$sub_user_id)  {
		$model =   $this->model;
		// $model = $model->whereDate('created_at', '!=', date('Y-m-d'));
		if($sub_user_id){
			$model = $model->whereHas('sub_user', function (Builder $query) use($sub_user_id) {
				if($sub_user_id){
					$query->where('sub_user_id',$sub_user_id);
				}
			});
		}
		if ($type == 'current-week') {
			$model = $model->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
		}
		else if ($type == 'last-week') {
			$previous_week = strtotime("-1 week +1 day");
			$start_week = strtotime("last sunday midnight",$previous_week);
			$end_week = strtotime("next saturday",$start_week);
			$start_week = date("Y-m-d",$start_week);
			$end_week = date("Y-m-d",$end_week);
		
			$model = $model->whereBetween('created_at', [$start_week, $end_week]);
		
		}
		return $model;
	}

    public function filterAll($type,$sub_user_id) 
	{
		$model = $this->filter($type,$sub_user_id);
		return $model->get();
	}



	
}

