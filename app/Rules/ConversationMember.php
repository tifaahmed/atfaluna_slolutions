<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Conversation;
use App\Models\Group_chat;


class ConversationMember implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $sub_user_id;

    public function __construct($sub_user_id)
    {
        $this->sub_user_id = $sub_user_id;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $conversation = Conversation::find($value);

        $group_chats_recevier = $conversation->group_chats()->where('recevier_id',$this->sub_user_id)->first();
        $conversation_sender = $conversation->where('sub_user_id',$this->sub_user_id)->first();

        return ( $conversation_sender || $group_chats_recevier ) ? 1 : 0 ;
        

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'that person do not belong to that conversation';
    }
}
