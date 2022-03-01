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

                            <InputsFactory :Factorylable="'Accessory'"  :FactoryPlaceholder="'Search'"
                                :FactoryType="'multiSelect'" :FactoryName="'accessory'"   v-model ="RequestData.UserRoles"  
                                :FactorySelectOptions="AccessoryRows"   :FactorySelectColumnName="['name']" 
                            />

                        </div>
                        <button  @click="FormSubmet()" class="btn btn-primary ">
                            Submit
                        </button>
                        
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
import Model                from 'AdminModels/SubUser';
import UserModel            from 'AdminModels/User';
import AccessoryModel        from 'AdminModels/Accessory';

import validation     from 'AdminValidations/SubUser';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default    {
        name:'SubUserCreate',
        components : { InputsFactory } ,

        async mounted() {
            this.GetUsers();
            this.GetAccessory();
        },
        data( ) { return {
            TableName :'SubUser',
            TablePageName :'SubUser.ShowAll',

            UserRows        :'null',
            AccessoryRows   :'null',

            ServerReaponse : {
                errors      : {
                    name    :[],
                    age     : [],
                    points  : [],
                    user_id : [],
                    gender  : [],
                },
                message : null,
            },
            RequestData : {
                name            : null,
                age             : null,
                points          : null,
                user_id         : null,
                gender          : null,
                accessory       : [],
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
                // clear errors
                await this.DeleteErrors();
                // valedate
                var check = await (new validation).validate(this.RequestData);
                if( check ){ // if there is error
                    this.ServerReaponse = check;
                }
                // valedate
                else{
                    await this.SubmetRowButton();// run the form
                }
            },
            async GetAccessory(page){
                this.AccessoryRows  = ( await this.AllAccessory() ).data.data[0];
            },
            async GetUsers(page){
                this.UserRows  = ( await this.AllUsers() ).data.data;
            },

            // model 
                AllUsers(){
                    return  (new UserModel).all()  ;
                },
                AllAccessory(){
                    return  (new AccessoryModel).all()  ;
                },
                store(){
                    return  (new Model).store(this.RequestData)  ;
                },
            // model 

            async SubmetRowButton(){
                this.ServerReaponse = null;
                let data = await this.store()  ;
                if(data && data.errors){
                    this.ServerReaponse = data ;
                }else{
                    this.ReturnToTablePag();//success from server
                }
            },

            async ReturnToTablePag( ) {
                return this.$router.push({ 
                    name: this.TablePageName , 
                    query: { CurrentPage: this.$route.query.CurrentPage } 
                })
            },

        },

    }
</script>