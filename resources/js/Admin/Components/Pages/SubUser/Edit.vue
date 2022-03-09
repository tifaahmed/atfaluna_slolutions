<template>
	<div class="container-fluid" >
        <div class="row row-sm">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Edit {{TableName}} </h4>
                    </div>
                    <div class="card-body pt-0">

                            <InputsFactory :Factorylable="'name'"  :FactoryPlaceholder="'name'"
                                :FactoryType="'string'" :FactoryName="'name'"   v-model ="RequestData.name" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.name )   ) ? ServerReaponse.errors.name : null"
                            />
                            <InputsFactory :Factorylable="'age'"  :FactoryPlaceholder="'age'"
                                :FactoryType="'number'" :FactoryName="'age'"   v-model ="RequestData.age" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.age )   ) ? ServerReaponse.errors.age : null"
                            />
                            <InputsFactory :Factorylable="'points'"  :FactoryPlaceholder="'points'"
                                :FactoryType="'number'" :FactoryName="'points'"   v-model ="RequestData.points" 
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.points )   ) ? ServerReaponse.errors.points : null"
                            />

                            <InputsFactory :Factorylable="'parent'" 
                                :FactoryType="'select'" :FactoryName="'user'"   v-model ="RequestData.user"  
                                :FactorySelectOptions="UserRows"   

                                :FactorySelectColumnName="'name'"  
                                :FactorySelectColumnOptions="['name','email']"  

                                :FactorySelectForloop="'UserRoles'"  
                                :FactorySelectForloopColumn="['name']" 

                                :FactorySelectimage="'avatar'"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.user_id )  ) ? ServerReaponse.errors.user_id : null" 
                            />


                            <InputsFactory :Factorylable="'Accessory'"  
                                :FactoryType="'multiSelect'" :FactoryName="'accessories'"   v-model ="RequestData.accessories"  
                                :FactorySelectOptions="AccessoryRows"  

                                :FactorySelectColumnName="'name'"  
                                :FactorySelectColumnOptions="['price']"  

                                :FactorySelectForloop="'languages'"  
                                :FactorySelectForloopColumn="['name','language']" 

                                :FactorySelectimage="'image'"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.accessories )  ) ? ServerReaponse.errors.accessories : null" 
                            />
                            <InputsFactory :Factorylable="'Avatars'"  
                                :FactoryType="'multiSelect'" :FactoryName="'avatars'"   v-model ="RequestData.avatars"  
                                :FactorySelectOptions="AvatarRows"  

                                :FactorySelectColumnName="'id'"  
                                :FactorySelectColumnOptions="['price','type']"  

                                :FactorySelectForloop="''"  
                                :FactorySelectForloopColumn="[]" 

                                :FactorySelectimage="'image'"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.avatar_ids )  ) ? ServerReaponse.errors.avatar_ids : null" 
                            />

                            <InputsFactory :Factorylable="'Avatar'" 
                                :FactoryType="'select'" :FactoryName="'avatar'"   v-model ="RequestData.avatar"  
                                :FactorySelectOptions="AvatarRows"   
                                :FactorySelectColumnName="'image'"  
                                :FactorySelectColumnOptions="['price','type']"  

                                :FactorySelectForloop="''"  
                                :FactorySelectForloopColumn="[]" 

                                :FactorySelectimage="'image'"  
                                :FactoryErrors="( ServerReaponse && Array.isArray( ServerReaponse.errors.avatar_id )  ) ? ServerReaponse.errors.avatar_id : null" 
                            />

                            <InputsFactory :Factorylable="'gender'"  :FactoryPlaceholder="'gender'"
                                :FactoryType="'radio'" :FactoryName="'gender'"   v-model ="RequestData.gender"  
                                :FactorySelectOptions="['boy','girl']"
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.gender )   ) ? ServerReaponse.errors.gender : null"
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
import Model     from 'AdminModels/SubUser';
import UserModel            from 'AdminModels/User';
import AccessoryModel        from 'AdminModels/Accessory';
import AvatarModel        from 'AdminModels/Avatar';

import validation     from 'AdminValidations/SubUser';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default {
        components : { InputsFactory } ,

        name:"SubUserEdit",

        mounted() {
            this.GetUsers();
            this.GetAccessories();
            this.GetAvatars();

            this.GetData();
            
        },
        data( ) { return {
            TableName :'SubUser',
            TablePageName :'SubUser.ShowAll',

            UserRows :null,
            AccessoryRows   :null,
            AvatarRows   :null,

            ServerReaponse : {
                errors : {
                    name        :[],
                    age         : [],
                    points      : [],
                    gender      : [],
                    
                    user_id     : [],
                    avatar_id     : [],
                    avatar_ids     : [],
                    accessory_ids     : [],
                },
                message : null,
            },
            RequestData : {
                name             : null,
                age              : null,
                points           : null,
                gender           : null,

                user_id          : null,
                user             : null,

                avatar_id        : null,
                avatar           : null,

                avatar_ids       : {},
                avatars          : [],

                accessory_ids    : {},
                accessories      : [],
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
                    // valedate
                    await this.DetectVueError();  
                    console.log(this.ServerReaponse.message) ;    
                    if (this.ServerReaponse.message == null) {
                        // handle data
                        await this.HandleData();  
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

                HandleData(){

                    if(this.RequestData.accessories){
                        var accessory_list =[];
                        this.RequestData.accessories.map(function(value, key) {
                            accessory_list[key] = value.id;
                        });
                        this.RequestData.accessory_ids = accessory_list;
                    }
                    if(this.RequestData.avatars){
                        var avatar_list =[];
                        this.RequestData.avatars.map(function(avatarValue, key) {
                            avatar_list[key] = avatarValue.id;
                        });
                        this.RequestData.avatar_ids = avatar_list;
                    }

                    if(this.RequestData.user){
                        this.RequestData.user_id = this.RequestData.user.id;
                    }
                    if(this.RequestData.avatar){
                        this.RequestData.avatar_id = this.RequestData.avatar.id;
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

            // relationship
                async GetUsers(page){
                    this.UserRows  = ( await this.AllUsers() ).data.data;
                },
                async GetAccessories(page){
                    this.AccessoryRows  = ( await this.AllAccessory() ).data.data;
                },
                async GetAvatars(page){
                    this.AvatarRows  = ( await this.AllAvatar() ).data.data;
                    console.log(this.AvatarRows);
                },
            // relationship

            // modal
                AllUsers(){
                    return  (new UserModel).all()  ;
                },
                AllAccessory(){
                    return  (new AccessoryModel).all()  ;
                },
                AllAvatar(){
                    return  (new AvatarModel).all()  ;
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