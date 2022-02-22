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
    </div>



</template>
<script>
import SideBarRight from 'AdminPartials/SideBarRight.vue' ;
import NavBar from       'AdminPartials/NavBar.vue' ;

    export default {
        mounted() {
            console.log( 'main dashboard home' );
        },
        components:{
            SideBarRight,NavBar
        },
    }
</script>