<template>
	<div class="container-fluid" >
        <div class="row row-sm">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Edit {{TableName}} </h4>
                    </div>
                    <div class="card-body pt-0">

                        <InputsFactory :Factorylable="'name'"  :FactoryPlaceholder=" 'en' "         
                            :FactoryType="'string'" :FactoryName="'name'"  v-model ="RequestData.name"  
                            :FactoryErrors="( ServerReaponse  && ServerReaponse.errors && Array.isArray( ServerReaponse.errors.name )  ) ? ServerReaponse.errors.name : null" 
                        />

                        <InputsFactory :Factorylable="'full name'"  :FactoryPlaceholder=" 'english' "         
                            :FactoryType="'string'" :FactoryName="'full_name'"  v-model ="RequestData.full_name"  
                            :FactoryErrors="( ServerReaponse && ServerReaponse.errors &&Array.isArray( ServerReaponse.errors.full_name )  ) ? ServerReaponse.errors.full_name : null" 
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
import Model     from 'AdminModels/Language';
import validation     from 'AdminValidations/Language';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default {
        components : { InputsFactory } ,

        name:"LanguageEdit",

        mounted() {
            this.show();
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

            // modal
                async show( ) {
                    this.RequestData = ( await (new Model).show( this.$route.params.id) ).data.data[0] ;
                },
                async update(){
                    return (new Model).update(this.RequestData.id , this.RequestData)  ;
                }
                // modal


        }
    }
</script>