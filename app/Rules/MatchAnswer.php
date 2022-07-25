<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use  App\Models\Match_answer;
class MatchAnswer implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $possition;

    public function __construct($possition)
    {
        $this->possition = $possition;
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
        $match_answer = Match_answer::where('match_question_id',$value)->where('possition',$this->possition)->count();

        return ( $match_answer >= 4  ) ? 0 : 1 ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'you reach limit of '. $this->possition .' match answer' ;
    }
}
