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

                            <InputsFactory :Factorylable="'age'"  :FactoryPlaceholder="'age'"
                                :FactoryType="'number'" :FactoryName="'age'"   v-model ="RequestData.age" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.age )   ) ? ServerReaponse.errors.age : null"
                            />

                            <InputsFactory :Factorylable="'AgeGroup'" 
                                :FactoryType="'select'" :FactoryName="'age_group_id'"   v-model ="RequestData.age_group"  
                                :FactorySelectOptions="AgeGroupRows"   
                                :FactorySelectColumnName="'name'"  
                                :FactorySelectColumnOptions="['age','name']"  

                                :FactorySelectForloop="'languages'"  
                                :FactorySelectForloopColumn="['name','language']" 

                                :FactorySelectimage="''"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.age_group_id )  ) ? ServerReaponse.errors.age_group_id : null" 
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
import Model                from 'AdminModels/Age';
import AgeGroupModel     from 'AdminModels/AgeGroup';

import validation     from 'AdminValidations/Age';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default    {
        name:'AgeCreate',
        components : { InputsFactory } ,

        async mounted() {
            this.GetAgeGroups();
        },
        data( ) { return {
            TableName :'Age',
            TablePageName :'Age.ShowAll',

            AgeGroupRows   : null,

            ServerReaponse : {
                errors      : {
                    age     : [],
                },
                message : null,
            },
            RequestData : {
                age             : null,     

                age_group_id          : null,
                age_group             : null,     
            },
        } } ,
        methods : {

            // before send to server
                async FormSubmet(){
                    //clear errors
                    await this.DeleteErrors();                
                    // valedate
                    await this.DetectVueError();  
                    console.log(this.ServerReaponse.message) ;    
                    // if (this.ServerReaponse.message == null) {
                        // handle data
                        await this.HandleData();  
                        // Submet from  
                        await this.SubmetRowButton(); 
                    // }
                
                },
                DeleteErrors(){
                    for (var key in this.ServerReaponse.errors) {
                        this.ServerReaponse.errors[key] = [];
                    }
                    this.ServerReaponse.message =null;
                },

                async DetectVueError(){
                    var check = await (new validation).validate(this.RequestData);
                    if( check ){// if there is error from my file
                        this.ServerReaponse = check; // error from my file
                    }
                },

                HandleData(){
                    if(this.RequestData.age_group){
                        this.RequestData.age_group_id = this.RequestData.age_group.id;
                    }
                },
            // before send to server

            // relationship
                async GetAgeGroups(){
                    this.AgeGroupRows  = ( await this.AllAgeGroups() ).data.data;
                },
            // relationship




            // after send to server
                async SubmetRowButton(){
                    var data = await this.store()  ; // send update request
                    if(data && data.errors){// stay and show error
                        await this.DetectServerError(data)  ;
                    }else{
                        await this.ReturnToTablePage();//success from server
                    }
                },
                async DetectServerError(data){
                    this.ServerReaponse = data ;//error from the server
                },
                async ReturnToTablePage( ) {
                    return this.$router.push({ 
                        name: this.TablePageName , 
                        query: { CurrentPage: this.$route.query.CurrentPage } 
                    })
                },
            // after send to server
 

            // model 
                AllAgeGroups(){
                    return  (new AgeGroupModel).all()  ;
                },
                store(){
                    return  (new Model).store(this.RequestData)  ;
                },
            // model 
        },

    }
</script>