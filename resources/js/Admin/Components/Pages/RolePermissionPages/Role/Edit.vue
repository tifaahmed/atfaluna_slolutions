<template>
	<div class="container-fluid" >
        <div class="row row-sm">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Edit {{TableName}} </h4>
                    </div>
                    <div class="card-body pt-0">

                        <InputsFactory :Factorylable="'name'"  :FactoryPlaceholder=" 'sub admin' "         :FactoryType="'string'" :FactoryName="'name'"  v-model ="RequestData.name"  :FactoryErrors="ServerReaponse.errors.name ? ServerReaponse.errors.name : null" />

                        


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
import Model     from 'AdminModels/Role';
import validation     from 'AdminValidations/Role';


import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default {
        components : { InputsFactory } ,

        name:"UserEdit",

        mounted() {
            this.show();
        },
        data( ) { return {
            TableName :'Role',

            ServerReaponse : {
                errors : {
                    name :[],
                },
                message : null,
            },
            RequestData : {
                name                    : null,
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

                // if there is error
                if( check ){
                    this.ServerReaponse = check;
                }
                else{
                    // run the form
                    await this.SubmetRowButton();
                }
            },
            async SubmetRowButton(){
                this.ServerReaponse = null;
                let data = await this.update()  ;
                if(data && data.errors){
                    this.ServerReaponse = data ;
                }else{
                    this.$router.push({ name: 'Role.ShowAll' , query: { CurrentPage: CurrentPage } })
                }
            },

            // modal
                async show( ) {
                    this.RequestData = ( await (new Model).show( this.$route.params.id) ).data.data.RoleModel ;
                },
                async update(){
                    return (new Model).update(this.RequestData.id , this.RequestData)  ;
                }
            // modal


        }
    }
</script>