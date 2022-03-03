<template>
	<div class="container-fluid" >
        <div class="row row-sm">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Edit {{TableName}} </h4>
                    </div>
                    <div class="card-body pt-0">

                        <InputsFactory :Factorylable="'User name'"  :FactoryPlaceholder=" '...... .......' "         
                            :FactoryType="'string'" :FactoryName="'name'"  v-model ="RequestData.name"  
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

                        <InputsFactory :Factorylable="'avatar'"  :FactoryPlaceholder="'avatar'"
                            :FactoryType="'file'" :FactoryName="'avatar'"  v-model ="RequestData.avatar"  
                            :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.avatar )  ) ? ServerReaponse.errors.avatar : null" 
                            />

                        <InputsFactory :Factorylable="'birthdate'"  :FactoryPlaceholder="'birthdate'"
                            :FactoryType="'date'" :FactoryName="'birthdate'"  v-model ="RequestData.birthdate"  
                            :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.birthdate )  ) ? ServerReaponse.errors.birthdate : null" 
                        />

                        <InputsFactory :Factorylable="'country'"  :FactoryPlaceholder="''"
                            :FactoryType="'select'" :FactoryName="'country_id'"   v-model ="RequestData.country_id"  
                            :FactorySelectOptions="CountriesRows"  :FactorySelected="RequestData.country"  :FactorySelectColumnName="'name'" 
                        />
                        <InputsFactory :Factorylable="'roles'"   v-model ="RequestData.UserRoles"  
                            :FactoryType="'multiSelectWithLang'" 
                            :FactoryName="'UserRoles'"  
                            :FactorySelectOptions="RolesRows"   
                            :FactorySelectColumnName="'name'"  
                        />
                        <InputsFactory :Factorylable="'Password'"  :FactoryPlaceholder=" '**********' "
                            :FactoryType="'password'" :FactoryName="'password'"  v-model ="RequestData.password"
                            :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.password )  ) ? ServerReaponse.errors.password : null" 
                        />
                        <InputsFactory :Factorylable="'Password Confirmation'"  :FactoryPlaceholder=" '**********' "
                            :FactoryType="'password'" :FactoryName="'password_confirmation'"  v-model ="RequestData.password_confirmation"
                            :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.password_confirmation )  ) ? ServerReaponse.errors.password_confirmation : null" 
                        />

                            

                        <button  @click="FormSubmet()" class="btn btn-primary  ">Submit</button>
                        


                        
                        <router-link style="color:#fff" 
                            :to = "{ 
                                name : TableName+'.ShowAll' , 
                                query: { CurrentPage: this.$route.query.CurrentPage }  
                            }" > 
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
import UserModel     from 'AdminModels/User';
import CountryModel     from 'AdminModels/Country';
import RoleModel        from 'AdminModels/Role';

import Validation     from 'AdminValidations/UserEdit';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default {
        components : { InputsFactory} ,

        name:"UserEdit",

        mounted() {
            this.GetCountries();
            this.GetlRoles();

            this.show();
        },
        data( ) { return {
            TableName :'User',
            TablePageName :'User.ShowAll',

            CountriesRows : [] ,
            RolesRows : [] ,

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
                birthdate               : null,
                country_id              : null,
                roleIdes                : [],
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
                var check = await (new Validation).validate(this.RequestData);

                
                if( check ){// if there is error from my file
                     this.ServerReaponse = check; // error from my file
                }else{ // run the form
                     this.SubmetRowButton(); // succes from file
                }
            },
            async SubmetRowButton(){
                this.ServerReaponse = null;
                var list =[];
                this.RequestData.UserRoles.map(function(value, key) {
                    list[key] = value.id;
                });
                this.RequestData.roleIdes = list;
                console.log(this.RequestData.roleIdes)
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

            async GetCountries(page){
                this.CountriesRows  = ( await this.AllCountries() ).data.data;
            },
            async GetlRoles(page){
                this.RolesRows  = ( await this.AllRoles() ).data.data;
            },
            
            // modal
                AllCountries(){
                    return  (new CountryModel).all()  ;
                },
                AllRoles(){
                    return  (new RoleModel).all()  ;
                },
                async show( ) {
                    this.RequestData = ( await (new UserModel).show( this.$route.params.id) ).data.data.UserModel ;
                },
                async update(){
                    return (new UserModel).update(this.RequestData.id , this.RequestData)  ;
                },
            // modal

        }
    }
</script>
