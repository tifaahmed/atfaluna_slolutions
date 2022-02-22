<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder {

    public function run( ) {

        app( )[ PermissionRegistrar::class ] -> forgetCachedPermissions( );


        Role::create( [ 'name' => 'sub-admin'   ,'guard_name' => 'api' ] )  ;
        Role::create( [ 'name' => 'super-admin' ,'guard_name' => 'api' ] )  ;
        Role::create( [ 'name' => 'admin'       ,'guard_name' => 'api' ] )  ;
        Role::create( [ 'name' => 'parent'      ,'guard_name' => 'api' ] )  ;

    }

}
