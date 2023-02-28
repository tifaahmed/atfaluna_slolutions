<?php

namespace App\Repository\Eloquent;

use App\Models\Conversation as ModelName;
use App\Repository\ConversationRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response ;

class ConversationRepository extends BaseRepository implements ConversationRepositoryInterface
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

	public function filter($sub_user_id,$has_message,$type)  {
		$model =   $this->model;
		if($sub_user_id){
			$model = $model->where('sub_user_id',$sub_user_id);
		}			
		if($has_message){
			$model = $model->whereHas('massages', function (Builder $query)   {
			});
		}
		if($type){
			$model = $model->where('type',$type);
		}
		return 	$model;
	}

	public function filterAll($sub_user_id,$has_message,$type)  
    {
		$model = $this->filter($sub_user_id,$has_message,$type)  ;
		return $model->get();
	}

	public function filterPaginate($sub_user_id,$has_message,$type,$itemsNumber)  
    {
		$model = $this->filter($sub_user_id,$has_message,$type)  ;
		return $model->paginate($itemsNumber)->appends(request()->query());
    }

	public function checkExist($sub_user_id,$recevier_ids,$type)  
    {
			return ModelName::
			where('sub_user_id',$sub_user_id)->
			where('type',$type)->
			whereHas('group_chat', function (Builder $query) use($recevier_ids) {
				$query->whereIn('recevier_id',$recevier_ids);
			})->
			get();
    }



	// public function attachRecevier($recevier_id,$id)  
    // {
	// 	if($recevier_id){
	// 		$conversation = $this->findById($id); 
			
	// 		$conversation_recevier =  $conversation->sub_user_id()->get();
	// 		foreach ($conversation_recevier as $key => $value) {
	// 			$value->sub_user_id()->dissociate()->save();
	// 		}

	// 		$recevier =  Sub_user::find($recevier_id);
	// 		$recevier->sub_user_id()->associate($conversation)->save(); 
	// 	}
	// }
	}


