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
                            <InputsFactory :Factorylable="'image'"  :FactoryPlaceholder="'image'"
                                :FactoryType="'file'" :FactoryName="'image'"   v-model ="RequestData.image" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.image )   ) ? ServerReaponse.errors.image : null"
                            />
                            <InputsFactory :Factorylable="'code'"  :FactoryPlaceholder=" '02' "         
                                :FactoryType="'string'" :FactoryName="'code'"  v-model ="RequestData.code"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.code )  ) ? ServerReaponse.errors.code : null" 
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
import Model     from 'AdminModels/Country';

import validation     from 'AdminValidations/Country';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default    {
        name:'CountryCreate',
        components : { InputsFactory } ,

        async mounted() {
        },
        data( ) { return {
            TableName :'Country',
            TablePageName :'Country.ShowAll',

            ServerReaponse : {
                errors : {
                    name  :[],
                    image :[],
                    code  :[],
                },
                message : null,
            },
            RequestData : {
                    name               : null,
                    image             : null,
                    code             : null,
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



            // model 
                store(){
                    return (new Model).store(this.RequestData)  ;
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