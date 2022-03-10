<template>
	<div class="container-fluid" >
        <div class="row row-sm">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Edit {{TableName}} </h4>
                    </div>
                    <div class="card-body pt-0">

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
import Model     from 'AdminModels/Age';
import AgeGroupModel     from 'AdminModels/AgeGroup';




import validation     from 'AdminValidations/Age';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default {
        components : { InputsFactory } ,

        name:"AgeEdit",

        mounted() {
            
            this.GetAgeGroups();
            this.GetData();
            
        },
        data( ) { return {
            TableName :'Age',
            TablePageName :'Age.ShowAll',

            AgeGroupRows   : null,

            ServerReaponse : {
                errors : {
                    age         : [],
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


            // before send to server
                async FormSubmet(){
                    //clear errors
                        await this.DeleteErrors();  
                    // handle data
                        await this.HandleData(); 
                    // valedate
                        await this.DetectVueError();  
                     if (this.ServerReaponse.message == null) {
                        // Submet from  
                        await this.SubmetRowButton(); 
                    }
                
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

                async GetAgeGroups(){
                    this.AgeGroupRows  = ( await this.AllAgeGroups() ).data.data;
                },
    

                HandleData(){

                   if(this.RequestData.age_group){
                        this.RequestData.age_group_id = this.RequestData.age_group.id;
                    }
                },
            // before send to server

            // after send to server
                async SubmetRowButton(){
                    var data = await this.update()  ; // send update request
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


            // modal
                AllAgeGroups(){
                    return  (new AgeGroupModel).all()  ;
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