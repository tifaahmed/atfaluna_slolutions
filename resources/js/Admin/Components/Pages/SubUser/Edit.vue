<template>
	<div class="container-fluid" >
        <div class="row row-sm">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Edit {{TableName}} </h4>
                    </div>
                    <div class="card-body pt-0">

                            <InputsFactory :Factorylable="'name'"  :FactoryPlaceholder="'name'"
                                :FactoryType="'string'" :FactoryName="'name'"   v-model ="RequestData.name" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.name )   ) ? ServerReaponse.errors.name : null"
                            />
                            <InputsFactory :Factorylable="'age'"  :FactoryPlaceholder="'age'"
                                :FactoryType="'number'" :FactoryName="'age'"   v-model ="RequestData.age" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.age )   ) ? ServerReaponse.errors.age : null"
                            />
                            <InputsFactory :Factorylable="'points'"  :FactoryPlaceholder="'points'"
                                :FactoryType="'number'" :FactoryName="'points'"   v-model ="RequestData.points" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.points )   ) ? ServerReaponse.errors.points : null"
                            />
                            <InputsFactory :Factorylable="'parent'"  :FactoryPlaceholder="''"
                                :FactoryType="'select'" :FactoryName="'user_id'"  v-model ="RequestData.user_id"  
                                :FactorySelectOptions="UserRows"    :FactorySelectColumnName="'name'" 
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.user_id )  ) ? ServerReaponse.errors.user_id : null" 
                            />

                            <InputsFactory :Factorylable="'gender'"  :FactoryPlaceholder="'gender'"
                                :FactoryType="'radio'" :FactoryName="'gender'"   v-model ="RequestData.gender"  
                                :FactorySelectOptions="['boy','girl']"
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.gender )   ) ? ServerReaponse.errors.gender : null"
                            />


                        <button  @click="FormSubmet()" class="btn btn-primary  ">Submit</button>
                        


                        
                        <router-link style="color:#fff" 
                            :to = "{ 
                                name : TableName+'.ShowAll' , 
                                query: { CurrentPage: this.$route.query.CurrentPage }  
                            }" 
                        > 
                        <button type="button" class="btn btn-danger  ">
                            <i class="fas fa-arrow-left">
                                    back
                            </i>
                        </button>
                        </router-link>



                        <div class="alert alert-danger " v-if="ServerReaponse && ServerReaponse.message"> {{ServerReaponse.message}}  </div>
                    </div>
                </div>
            </div>
        </div>


  

	</div>
</template>
<script>
import Model     from 'AdminModels/SubUser';
import UserModel        from 'AdminModels/User';

import validation     from 'AdminValidations/SubUser';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default {
        components : { InputsFactory } ,

        name:"SubUserEdit",

        mounted() {
            this.GetUsers();
            this.GetData();
            
        },
        data( ) { return {
            TableName :'SubUser',
            TablePageName :'SubUser.ShowAll',

            UserRows :'null',

            ServerReaponse : {
                errors : {
                    name  :[],
                    age             : null,
                    points             : null,
                    user_id             : null,
                    gender             : null,
                },
                message : null,
            },
            RequestData : {
                name               : null,
                age             : null,
                points             : null,
                user_id             : null,
                gender             : null,
            },

        } } ,
        methods : {


            DeleteErrors(){
                for (var key in this.ServerReaponse.errors) {
                    this.ServerReaponse.errors[key] = [];
                }
                this.ServerReaponse.message =null;
            },
            async GetData(){
                let receivedData = await this.show( ) ;
                for (var key in receivedData) {
                    if(  
                        ( Array.isArray( receivedData[key] )  && (receivedData[key]).length > 0 ) 
                        ||  
                        ( !Array.isArray( receivedData[key] ) &&receivedData[key] != null) 
                    ) {
                        this.RequestData[key] = receivedData[key];
                    }
                }
            },

            
            async FormSubmet(){
                //clear errors
                await this.DeleteErrors();                
                // valedate
                var check = await (new validation).validate(this.RequestData);
                if( check ){// if there is error from my file
                     this.ServerReaponse = check; // error from my file
                }else{ // run the form

                     this.SubmetRowButton(); // succes from file
                }
            },
            async SubmetRowButton(){
                this.ServerReaponse = null;
                let data = await this.update()  ; // send update request
                if(data && data.errors){// stay and show error
                    this.ServerReaponse = data ;//error from the server
                }else{//return to the Table
                    this.ReturnToTablePag();//success from server
                }
            },
            async ReturnToTablePag( ) {
                return this.$router.push({ 
                    name: this.TablePageName , 
                    query: { CurrentPage: this.$route.query.CurrentPage } 
                })
            },

            async GetUsers(page){
                this.UserRows  = ( await this.AllUsers() ).data.data;
            },
            // modal
                AllUsers(){
                    return  (new UserModel).all()  ;
                },
                async show( ) {
                    return ( await (new Model).show( this.$route.params.id) ).data.data[0] ;
                },
                update(){
                    return (new Model).update(this.RequestData.id , this.RequestData)  ;
                }
            // modal


        }
    }
</script>