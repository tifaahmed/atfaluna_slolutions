<?php

namespace App\Repository\Eloquent;

use App\Models\Hero as ModelName;
use App\Repository\HeroRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response ;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use URL;
use App\Models\Massage;


class HeroRepository extends BaseRepository implements HeroRepositoryInterface
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
		if($sub_user_id ){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			// first
			$all_sub_user_age_group =  $sub_user->subUserAgeGroup()->get();// check only
			if ($all_sub_user_age_group->count() ) {
				$active_subjects      =$sub_user->ActiveSubjectsFromActiveAgeGroup()->get();
			}else{
                return Response()->json( 
                    [
                        'message' => 'there is no age_group for this child' ,
                        'check' => 'false.' ,
                        'code'   => Response::HTTP_NOT_FOUND           ,
                    ],
                );			
			}
			// second
			if ( isset($active_subjects) && $active_subjects) {
				$result = new Collection; // to collect all lessons
				foreach ($active_subjects as $key => $value) {
					$lesssons = $value->lesssons()->get();
					$result = $result->merge( $lesssons );
				}	
				$lessson_ids = $result->pluck('id')->toArray();
		
			}else{
				return Response()->json( 
					[
						'message' => 'there is no active_subjects for this child' ,
						'check' => 'false.' ,
						'code'   => Response::HTTP_NOT_FOUND           ,
					],
				);	
			}
			// third
			if ( isset($lessson_ids) && $lessson_ids) {
				return ModelName::whereHas('herolesson',function (Builder $query) use($lessson_ids) {
					$query->whereIn('lesson_id',$lessson_ids);
				})->get();
			}else{
				return Response()->json( 
					[
						'message' => 'there is no lessons' ,
						'check' => 'false.' ,
						'code'   => Response::HTTP_NOT_FOUND           ,
					],
				);	
			}
		}else{
			return $this->all()  ;
		}	
	}

	public function filterPaginate($sub_user_id,$itemsNumber)  
    {
		if($sub_user_id ){
			$sub_user       = Auth::user()->sub_user()->find($sub_user_id);
			// first
			$all_sub_user_age_group =  $sub_user->subUserAgeGroup()->get();// check only
			if ($all_sub_user_age_group->count() ) {
				$active_subjects      =$sub_user->ActiveSubjectsFromActiveAgeGroup()->get();
			}else{	
				return abort( Response::HTTP_NOT_FOUND , 'there is no age_group for this child');			
			}
			// second
			if ( isset($active_subjects) && $active_subjects) {
				$result = new Collection; // to collect all lessons
				foreach ($active_subjects as $key => $value) {
					$lesssons = $value->lesssons()->get();
					$result = $result->merge( $lesssons );
				}	
				$lessson_ids = $result->pluck('id')->toArray();
		
			}else{
				return abort( Response::HTTP_NOT_FOUND , 'there is no active_subjects for this child');			
			}
			// third
			if ( isset($lessson_ids) && $lessson_ids) {
				$heros =  ModelName::whereHas('herolesson',function (Builder $query) use($lessson_ids) {
					$query->whereIn('lesson_id',$lessson_ids);
				});
				return $this->queryPaginate($heros,$itemsNumber,null,URL::full());

			}else{	
				return abort( Response::HTTP_NOT_FOUND , 'there is no lessons');			
			}
		}else{
			return $this->collection( $itemsNumber)  ;
		}	
	}

    public function attachLessons($lesson_ids,$id)
	{
		if($lesson_ids && $id){
			$result = $this->findById($id); 
			$result->herolesson()->sync($lesson_ids);
			return 'success';
		}
	}

	public function attachMassage($massage_id, $id)
	{
		$hero = $this->findById($id);

		$hero_massages = $hero->massage()->get();

		foreach ($hero_massages as $key => $value){
			$value->massageable()->diassociate()->save();
		}
		$massage = Massage::find($massage_id);
		$massage->massagable()->associate($hero)->save();
	}

}
