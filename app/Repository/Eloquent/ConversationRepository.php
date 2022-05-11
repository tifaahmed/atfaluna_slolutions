<?php

namespace App\Repository\Eloquent;

use App\Models\Conversation as ModelName;
use App\Models\Group_chat;
use App\Models\Sub_user;
use App\Repository\ConversationRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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
	public function store($sub_user_id,$recevier_ids,$type)  
    {
			
			$conversations = ModelName::where('type','single')->where('sub_user_id',$sub_user_id)->get()  ; 

			$flag = 0 ;
			foreach ($conversations as $key => $value) {
				$group_chat = $value->group_chats()->whereIn('recevier_id',$recevier_ids)->first();
				if ($group_chat) {
					$flag = 1;
				}
			}
			return  $flag;
			// $group = Group_chat::where('recevier_id',$conversation)->get()  ; 

			// $new_group = Group_chat::where('type','=','single',$group)->get()  ; 

		// }else{
		// 	$recevier =  Sub_user::find($recevier_id);

		// 	$recevier->sub_user_id()->associate($recevier)->save(); 
		// }
		// return $sub_user->conversation()->get();

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


