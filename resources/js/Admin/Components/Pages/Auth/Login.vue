<template>

    <div >
        <p id="text" style="color:green; margin-left:100px;"></p>
        <form action="#" @submit.prevent="login" @keydown="form.onKeydown($event)">
            <div class="form-group">

                <label>Email Or Phone</label> 
                <input v-model="form.email" class="form-control" placeholder="Enter your email or phone" type="text">
                <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" />

            </div>
            <div class="form-group">

                <label>الرقم السري</label> 
                <input v-model="form.password" class="form-control" placeholder="Enter your password" type="password">

            </div>

            <button type="submit" :disabled="form.busy" class="btn btn-main-primary btn-block">
                الدخول
            </button>
            <div class="row row-xs">
                <!-- <div class="col-sm-6">
                    <button class="btn btn-block"><i class="fab fa-facebook-f"></i> Signup with Facebook</button>
                </div> -->
                <!-- <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                    <button class="btn btn-info btn-block"><i class="fab fa-twitter"></i> Signup with Twitter</button>
                </div> -->
            </div>

        </form>
    </div>
</template>
<script>
import Axios from 'axios' ;
import jwt   from 'MainServices/jwt' ;
import RolePermision   from 'MainServices/RolePermision' ;

import { Form, HasError, AlertError } from 'vform'

window.Form = Form;

    export default {
        mounted() {
            console.log( 'login page ' )
        },
        data () { return {
            form: new Form({
              email: '',
              password: '',
              fcm_token : 'jjjjjjjj'
            })
        }},  



        
        methods: {
            async login () {

                this.form.post('/api/dashboard/auth/login')
                .then(( response ) => { 
                    var attr = document.getElementById("text");

                    attr.innerHTML = response.data.message; 

                    if(response.data.message == 'Successful') {
                        this.form.reset();
                        let user_data = response.data.data;
                            console.log( user_data , '00000')

                        let jwt_ =  jwt.login(user_data)  ;
                        

                        // if ( jwt_.Authorization !=null && !jwt_.if_accessToken_expire ) {

                            // RolePermision.SetUserRolesPermissions(jwt_.User)

                            this.$router.push('/dashboard'); 
                        // }

                    }

                })
            }
        }
   }


</script>