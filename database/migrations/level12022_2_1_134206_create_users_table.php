<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up( ) {
        Schema::create( 'users' , function ( Blueprint $table ) {
            $table->increments      ('id'        )                             ;
            $table -> rememberToken (            )                             ;
            $table->string('token', 60)-> nullable( )->unique();
            $table -> string        ( 'name'     ) -> nullable( )              ;
            $table -> string        ( 'email'    ) -> unique( ) ;
            $table->timestamp('email_verified_at')->nullable();
            $table -> string        ( 'avatar'   ) -> nullable( )              ;
            $table -> string        ( 'phone'    ) -> unique( ) ;
            $table -> string        ( 'password' ) -> nullable( )              ;
            $table -> date          ('birthdate'  )-> nullable( ); 
            $table -> boolean       ( 'active'   ) -> default (0)              ;
            $table -> boolean       ( 'online'   ) -> default (0)              ;
            $table->integer('country_id') -> nullable( )->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table -> string        ( 'login_type') -> nullable( )              ;
            $table -> string        ( 'latitude'  ) -> nullable( )              ;
            $table -> string        ( 'longitude' ) -> nullable( )              ;
            $table -> integer         ( 'pin_code'  ) -> nullable( ) -> unique( ) ;
            $table -> string         ( 'fcm_token'  ) -> nullable( ) ;
            
            $table->softDeletes();
            $table -> timestamps    (            )                             ;
        });
        // DB::table('users')->insert(
        //     array(
        //         'id'   => '1',
        //         'name'   => 'super admin',
        //         'password'   => '$2y$10$XMa9E1ZcQw2HH6faVJqq4uRbNCV3bnAutPRmJhH0vxkKBHtm6KGMK',//123456
        //         'email'   => 'admin@admin.com',
        //         'avatar'   => '',                
        //         'phone'   => '0111111',                
        //       )
        // );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down( ) {
        Schema::dropIfExists( 'users' );
    }
}
