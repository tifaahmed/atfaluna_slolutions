<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition( ) {
        return [
            'name'     => $this -> faker -> unique( ) -> name        ( ) ,
            'email'    => $this -> faker -> unique( ) -> safeEmail   ( ) ,
            'phone'    => $this -> faker -> unique( ) -> phoneNumber ( ) ,
            'password' => '$2y$04$HHcKsdqZWS6rPEwjNjAvPuiTjm7euqWhBJ2pB98Y0QaRVd4.OMgx6', // password1A
        ];
    }

}
