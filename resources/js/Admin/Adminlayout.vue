<template>
    <!-- Page -->
    <div class="page">

        <!-- main-sidebar -->
        <SideBarRight/> 
        <!-- main-sidebar -->

        <!-- main-header opened -->
        <div class="main-content app-content">
            <NavBar/> 
             

            <router-view></router-view>
       </div>
       <SideBarLeft/> 

    </div>


</template>
<script>
import SideBarRight from 'AdminPartials/SideBarRight.vue' ;
import SideBarLeft from  'AdminPartials/SideBarLeft.vue' ;
import NavBar from       'AdminPartials/NavBar.vue' ;

import jwt   from 'MainServices/jwt' ;
import RolePermision   from 'MainServices/RolePermision' ;
import UserModel   from 'AdminModels/User' ;

    export default {
        mounted() {
            console.log( ' Welcome ' );
            this.RolePermision();
        },
        components:{
            SideBarRight,NavBar,SideBarLeft
        },
        methods : {
            show(UserId) {
                return (new UserModel).show( UserId);
            },

            async RolePermision( ) {

               var user = await this.show( jwt.User.id);
               RolePermision.SetUserRolesPermissions(user.data.data.UserModel)
            }

        }
        
    }
</script>