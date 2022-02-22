<template>
	<div class="container-fluid" >
        <div class="row row-sm">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Edit {{TableName}} </h4>
                    </div>
                    <div class="card-body pt-0">


                        <span v-for="( row    , rowkey ) in LanguagesRows " :key="rowkey" >
                            <!-- (LanguagesRows) loop on ar & en -->
                            <span v-for="( row_    , rowkey_ ) in Languagescolumn " :key="rowkey_" >
                                <label >{{row_+' ( ' + row.full_name + ' ) '}}</label>
                                <input :placeholder="  row_+' ( ' + row.name + ' ) '" class="form-control" 
                                v-model ="RequestData.languages[rowkey][row_]" />
                            </span>
                        </span>

                        <InputsFactory :Factorylable="'age'"  :FactoryPlaceholder=" 'age' "         
                            :FactoryType="'string'" :FactoryName="'age'"  v-model ="RequestData.age"  
                            :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.age )  ) ? ServerReaponse.errors.age : null" 
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
import Model     from 'AdminModels/AgeGroup';
import LanguageModel     from 'AdminModels/Language';

import validation     from 'AdminValidations/AgeGroup';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default {
        components : { InputsFactory } ,

        name:"AgeGroupEdit",

        mounted() {
            this.GetlLanguages();
            this.GetData();
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
            async GetlLanguages(page){
                this.LanguagesRows  = ( await this.AllLanguages() ).data.data;
                let languages = this.RequestData.languages;
                for (var key in this.LanguagesRows) {
                    languages[key] = [];
                        Vue.set( languages[key],  'language');
                        languages[key].language = this.LanguagesRows[key].name;
                    for (var key_ in this.Languagescolumn) {
                        Vue.set( languages[key],  this.Languagescolumn[key_]);
                        languages[key][this.Languagescolumn[key_]] = "";
                    }
                }
                console.log(this.RequestData);
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
                AllLanguages(){
                    return  (new LanguageModel).all()  ;
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