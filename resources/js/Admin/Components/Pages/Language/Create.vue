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
                            <InputsFactory :Factorylable="'name'"  :FactoryPlaceholder=" 'en' "         
                                :FactoryType="'string'" :FactoryName="'name'"  v-model ="RequestData.name"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.name ) ) ? ServerReaponse.errors.name : null"
                            />

                            <InputsFactory :Factorylable="'full name'"  :FactoryPlaceholder=" 'english' "         
                                :FactoryType="'string'" :FactoryName="'full_name'"  v-model ="RequestData.full_name"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.full_name )  ) ? ServerReaponse.errors.full_name : null" 
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
// import Axios from 'axios' ;
import Model     from 'AdminModels/Language';
import validation     from 'AdminValidations/Language';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default    {
        name:'LanguageCreate',
        components : { InputsFactory } ,

        async mounted() {
        },
        data( ) { return {
            TableName :'Language',
            TablePageName :'Language.ShowAll',
            
            ServerReaponse : {
                errors : {
                    name :[],
                    full_name :[],
                },
                message : null,
            },
            RequestData : {
                name                    : null,
                full_name               : null,
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
                var check = await (new validation).validate(this.RequestData);

                if( check ){ // if there is error
                    this.ServerReaponse = check;
                }
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