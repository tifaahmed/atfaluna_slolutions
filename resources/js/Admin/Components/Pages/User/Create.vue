<template>
    <div class="container-fluid" >


        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Create {{TableName}} </h4>
                    </div>
                    <div class="card-body pt-0">

                        <div class="">
                            <InputsFactory :Factorylable="'name'" :FactoryPlaceholder=" 'mohamed' "
                                :FactoryType="'string'" :FactoryName="'name'" v-model ="RequestData.name"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.name )  ) ? ServerReaponse.errors.name : null" 
                            />
                            <InputsFactory :Factorylable="'Email'"  :FactoryPlaceholder=" '---@---.---' "
                                :FactoryType="'email'" :FactoryName="'email'"  v-model ="RequestData.email"
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.email )  ) ? ServerReaponse.errors.email : null" 
                            />
                            <InputsFactory :Factorylable="'Phone'"  :FactoryPlaceholder=" '00201---------' "
                                :FactoryType="'number'" :FactoryName="'phone'"  v-model ="RequestData.phone"
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.phone )  ) ? ServerReaponse.errors.phone : null" 
                            />
                            <InputsFactory :Factorylable="'Image'"  :FactoryPlaceholder="'Image'"
                                :FactoryType="'file'" :FactoryName="'avatar'"   v-model ="RequestData.avatar"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.avatar )  ) ? ServerReaponse.errors.avatar : null" 
                                />
                            <InputsFactory :Factorylable="'birthdate'"  :FactoryPlaceholder="'birthdate'"
                                :FactoryType="'date'" :FactoryName="'birthdate'"  v-model ="RequestData.birthdate"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.birthdate )  ) ? ServerReaponse.errors.birthdate : null" 
                            />
                            <InputsFactory :Factorylable="'country'"  :FactoryPlaceholder="''"
                                :FactoryType="'select'" :FactoryName="'country_id'"  v-model ="RequestData.country_id"  
                                :FactorySelectOptions="CountriesRows"  :FactorySelected="RequestData.country"  :FactorySelectColumnName="'name'" 
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.country_id )  ) ? ServerReaponse.errors.country_id : null" 
                            />
                            <InputsFactory :Factorylable="'Password'"  :FactoryPlaceholder=" '********' "
                                :FactoryType="'password'" :FactoryName="'password'"  v-model ="RequestData.password"
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.password )  ) ? ServerReaponse.errors.password : null" 
                            />
                            <InputsFactory :Factorylable="'Password Confirmation'"  :FactoryPlaceholder=" '********' "
                                :FactoryType="'password'" :FactoryName="'password_confirmation'"  v-model ="RequestData.password_confirmation"
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.password_confirmation )  ) ? ServerReaponse.errors.password_confirmation : null" 
                            />

                            
                        </div>
                        <button  @click="FormSubmet()" class="btn btn-primary ">
                            Submit
                        </button>
                        
                        <router-link style="color:#fff" :to = "{ name : TableName+'.ShowAll' }" > 
                            <button type="button" class="btn btn-danger  ">
                                <i class="fas fa-arrow-left">
                                        back
                                </i>
                            </button>
                        </router-link>

                        <div class="alert alert-danger " v-if="ServerReaponse && ServerReaponse.message"> 
                            {{ServerReaponse.message}}
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</template>



<script>
// import Axios from 'axios' ;
import UserModel     from 'AdminModels/User';
import validationUser     from 'AdminValidations/User';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default    {
        name:'UserCreate',
        components : { InputsFactory } ,

        async mounted() {
        },
        data( ) { return {
            TableName :'User',
            CountriesRows :'null',

            ServerReaponse : {
                errors : {
                    name :[],
                    email :[],
                    phone :[],
                    avatar :[],
                    password :[],
                    password_confirmation :[],
                    birthdate :[],
                    country_id :[],
                },
                message : null,
            },
            RequestData : {
                name                    : null,
                email                   : null,
                phone                   : null,
                avatar                  : null,
                password                : null,
                password_confirmation   : null,
                country_id              : null,
                country                 : null            
            },

        } } ,
        methods : {
            DeleteErrors(){
                for (var key in this.ServerReaponse.errors) {
                    this.ServerReaponse.errors[key] = [];
                }
                this.ServerReaponse.message =null;
            },

            async FormSubmet(){
                //clear errors
                await this.DeleteErrors();
                // valedate
                var check = await (new validationUser).validate(this.RequestData);

               
                if( check ){ // if there is error
                    this.ServerReaponse = check;
                }
                else{
                    await this.SubmetRowButton();// run the form
                }
            },

            // model 
            store(){
                return (new UserModel).store(this.RequestData)  ;
            },
            // model 



            async SubmetRowButton(){
                this.ServerReaponse = null;
                let data = await this.store()  ;
                if(data && data.errors){
                    this.ServerReaponse = data ;
                }else{
                    this.$router.push({ name: 'User.ShowAll' })
                }
            },



            
        },

    }
</script>