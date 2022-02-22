<template>

    <div class="page">
        <div class="container-fluid">
            <div class="row no-gutter">
                <!-- The image half -->
                <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                    <div class="row wd-100p mx-auto text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <img src="" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                        </div>
                    </div>
                </div>
                <!-- The content half -->
                <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                    <div class="login d-flex align-items-center py-2">
                        <!-- Demo content-->
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                    <div class="card-sigin">
                                        <div class="mb-5 d-flex"> 
                                            <a href="login.php">
                                                <img src="" class="sign-favicon ht-40" alt="logo">
                                            </a>
                                            <div class="card-sigin">
                                                <div class="main-signup-header">
                                                    <h2>vd system</h2>
                                                    
                                                    <router-view></router-view>

                                                    <div class="main-signin-footer mt-5">
                                                        <p><a href="">Forgot password?</a></p>
                                                        <p>Don't have an account? <a href="page-signup.html">Create an Account</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End -->
                        </div>
                    </div><!-- End -->
                </div>
            </div>

        </div>
    </div>
</template>



<script>
    export default {
        mounted() {
            console.log( 'auth home ' )
        },
    }
</script>