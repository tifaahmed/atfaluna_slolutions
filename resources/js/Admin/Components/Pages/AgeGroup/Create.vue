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

                            <InputsFactory :Factorylable="'age'"  :FactoryPlaceholder=" 'age' "         
                                :FactoryType="'string'" :FactoryName="'age'"  v-model ="RequestData.age"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.age )  ) ? ServerReaponse.errors.age : null" 
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
import Model     from 'AdminModels/AgeGroup';
import LanguageModel     from 'AdminModels/Language';

import validation     from 'AdminValidations/AgeGroup';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default    {
        name:'AgeGroupCreate',
        components : { InputsFactory } ,

        async mounted() {
            this.GetlLanguages();
        },
        data( ) { return {
            TableName :'AgeGroup',
            TablePageName :'AgeGroup.ShowAll',
            LanguagesRows : null,
            Languagescolumn : ['name'],


            ServerReaponse : {
                errors : {
                    age :[],
                },
                message : null,
            },
            RequestData : {
                    age     : null,

                    languages         : { },
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