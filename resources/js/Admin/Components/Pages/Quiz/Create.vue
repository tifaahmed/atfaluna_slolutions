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

                            <span v-for="( row    , rowkey ) in LanguagesRows " :key="rowkey" >
                                <span v-for="( row_    , rowkey_ ) in Languagescolumn " :key="rowkey_" >
                                    <!-- (LanguagesRows) loop on ar & en -->
                                        <label >{{row_+' ( ' + row.full_name + ' ) '}}</label>
                                        <input :placeholder="  row_+' ( ' + row.name + ' ) '" class="form-control" 
                                        v-model ="RequestData.languages[rowkey][row_]"  
                                        />
                                    <!-- (LanguagesRows) loop on ar & en -->
                                </span>
                            </span>

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
                            <InputsFactory :Factorylable="'image'"  :FactoryPlaceholder="'image'"
                                :FactoryType="'file'" :FactoryName="'image'"   v-model ="RequestData.image"  
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.image )   ) ? ServerReaponse.errors.image : null"
                            />


                             <InputsFactory :Factorylable="'points'"  :FactoryPlaceholder="'points'"
                                :FactoryType="'number'" :FactoryName="'points'"   v-model ="RequestData.points" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.points )   ) ? ServerReaponse.errors.points : null"
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
import Model                from 'AdminModels/Quiz';
import AgeGroupModel     from 'AdminModels/AgeGroup';
import LanguageModel     from 'AdminModels/Language';

import validation     from 'AdminValidations/Quiz';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default    {
        name:'AgeCreate',
        components : { InputsFactory } ,

        async mounted() {
            this.GetAgeGroups();
            this.GetlLanguages();
        },

        data( ) { return {
            TableName :'Quiz',
            TablePageName :'Quiz.ShowAll',
            Languagescolumn : ['name'],

            AgeGroupRows   : null,
            LanguagesRows : null,

              ServerReaponse : {
                errors : {
                    image :[],
                    points :[],
                    age_group_id :[],
                },
                message : null,
            },
            RequestData : {
                    points          : null,
                    image           : null, 

                    languages       : { },

                    age_group_id    : null,
                    age_group       : null,   

            },

        } } ,
        methods : {

            // before send to server
                async FormSubmet(){
                    //clear errors
                    await this.DeleteErrors(); 
                    // handle data
                    await this.HandleData();  
                    // valedate
                    await this.DetectVueError();  
                    console.log(this.ServerReaponse.message) ;    
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



            async GetlLanguages(page){
                this.LanguagesRows  = ( await this.AllLanguages() ).data.data;
                let languages = this.RequestData.languages;
                for (var key in this.LanguagesRows) {
                    languages[key] = [];
                        Vue.set( languages[key],  'language');
                        languages[key].language = this.LanguagesRows[key].name;
                    for (var key_ in this.Languagescolumn) {
                        Vue.set( languages[key],  this.Languagescolumn[key_]);
                        languages[key][this.Languagescolumn[key_]] = null;
                    }
                }
                this.RequestData.languages = languages;
                console.log(this.RequestData);
            },



            // model 
                AllLanguages(){
                    return  (new LanguageModel).all()  ;
                },
                
                store(){
                    return (new Model).store(this.RequestData)  ;
                },
            // model 


                async DetectVueError(){
                    var check = await (new validation).validate(this.RequestData);
                    if( check ){// if there is error from my file
                        this.ServerReaponse = check; // error from my file
                    }
                    console.log(this.ServerReaponse);
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