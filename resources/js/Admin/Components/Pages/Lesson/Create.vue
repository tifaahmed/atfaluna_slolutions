<template>
    <div class="container-fluid" >


        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Create {{TableName}} </h4>
                    </div>
                    <div class="card-body pt-0">
                    

                            <span v-for="( row    , rowkey ) in LanguagesRows " :key="rowkey" >
                                <!-- (LanguagesRows) loop on ar & en -->
                                <span v-for="( row_    , rowkey_ ) in LanguagesColumn " :key="rowkey_" >
                                    <InputsFactory :Factorylable="row_.header+' ( ' + row.full_name + ' ) '" :FactoryPlaceholder="row_.placeholder"         
                                        :FactoryType="row_.type" :FactoryName="row_.name"  v-model ="RequestData.languages[rowkey][row_.name]"  
                                        :FactoryErrors="null" 
                                    />
                                </span>
                                <hr>
                            </span> 

                             <InputsFactory :Factorylable="'points'"  :FactoryPlaceholder="'points'"
                                :FactoryType="'number'" :FactoryName="'points'"   v-model ="RequestData.points" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.points )   ) ? ServerReaponse.errors.points : null"
                            />
      
                            <InputsFactory :Factorylable="'Chapter'" 
                                :FactoryType="'select'" :FactoryName="'sub_subject_id'"   v-model ="RequestData.subSubject"  
                                :FactorySelectOptions="SubSubjectRows"   
                              
                                :FactorySelectForloop="'languages'"  
                                :FactorySelectForloopColumn="['name','language']" 

                                :FactorySelectimage="''"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.sub_subject_id )  ) ? ServerReaponse.errors.sub_subject_id : null" 
                            />

                            <InputsFactory :Factorylable="'Lesson Type'" 
                                :FactoryType="'select'" :FactoryName="'lesson_type_id'"   v-model ="RequestData.lessonType"  
                                :FactorySelectOptions="LessonTypeRows"   

                                :FactorySelectColumnName="'name'"  
                                :FactorySelectColumnOptions="['name']"      

                                 :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.lesson_type_id )  ) ? ServerReaponse.errors.lesson_type_id : null"       
                            />




                        
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
import Model          from 'AdminModels/Lesson';
import SubSubjectModel  from 'AdminModels/Subsubject';
import LessonTypeModel  from 'AdminModels/LessonType';
import LanguageModel  from 'AdminModels/Language';


import validation     from 'AdminValidations/Lesson';
import InputsFactory  from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default    {
        name:'LessonCreate',
        components : { InputsFactory } ,

        async mounted() {
            this.GetlLanguages();
            this.GetSubSubject();
            this.GetLessonType();
        },

        data( ) { return {
            TableName :'Lesson',
            TablePageName :'Lesson.ShowAll',


            LanguagesRows : null,
            LanguagesColumn : [
                { type: 'string'  ,placeholder:'name',header :'name', name : 'name'},
                { type: 'file'    ,placeholder:'image',header :'image', name : 'image'},
                { type: 'file'    ,placeholder:'url',header :'url', name : 'url'},    
            ],




            SubSubjectRows   : null,
            LessonTypeRows   : null,
            

              ServerReaponse : {
                errors : {
                    points :[],
                    sub_subject_id : [],
                    lesson_type_id : [],
                },
                message : null,
            },
            RequestData : {
                    points          : null,

                    sub_subject_id     : null,
                    subSubject         : null,

                    lesson_type_id     : null,
                    lessonType         : null,

                    languages       : { },


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

                async DetectVueError(){
                    var check = await (new validation).validate(this.RequestData);
                    if( check ){// if there is error from my file
                        this.ServerReaponse = check; // error from my file
                    }
                    console.log(this.ServerReaponse);
                },

                HandleData(){
                    if(this.RequestData.subSubject){
                        this.RequestData.sub_subject_id = this.RequestData.subSubject.id;
                    }

                      if(this.RequestData.lessonType){
                        this.RequestData.lesson_type_id = this.RequestData.lessonType.id;
                    }

                },


            async GetlLanguages(){
                this.LanguagesRows  = ( await this.AllLanguages() ).data.data; // all languages
                let item_languages = this.RequestData.languages; // item language data
                let handleLanguages= {}; //handle Languages from item data & all languages

                for (var key in this.LanguagesRows) {
                    handleLanguages[key] = [];
                        Vue.set( handleLanguages[key],  'language'); // language key
                        handleLanguages[key].language = this.LanguagesRows[key].name;//fr & en & ar
                    for (var key_ in this.LanguagesColumn) {
                        Vue.set( handleLanguages[key],  this.LanguagesColumn[key_].name); // ex (name,image,desc,subject) key
                        if(  item_languages[key] &&  item_languages[key]['language'] ==  this.LanguagesRows[key].name ){
                            handleLanguages[key][this.LanguagesColumn[key_].name] = item_languages[key][this.LanguagesColumn[key_].name] ;
                        }
                    }
                }
                this.RequestData.languages = '';
                this.RequestData.languages = handleLanguages;
            },




            // relationship
            async GetSubSubject(page){
                this.SubSubjectRows  = ( await this.AllSubSubject() ).data.data;
            },


             async GetLessonType(page){
                this.LessonTypeRows  = ( await this.AllLessonType() ).data.data;
            },


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
                 AllLanguages(){
                    return  (new LanguageModel).all()  ;
                },

                 AllSubSubject(){
                     return  (new SubSubjectModel).all()  ;
                },

                 AllLessonType(){
                     return  (new LessonTypeModel).all()  ;
                },

                store(){
                    return  (new Model).store(this.RequestData)  ;
                },
            // model 
        },

    }
</script>