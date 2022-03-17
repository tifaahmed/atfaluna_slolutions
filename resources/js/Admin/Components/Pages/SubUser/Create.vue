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

                            <InputsFactory :Factorylable="'gender'"  :FactoryPlaceholder="'gender'"
                                :FactoryType="'radio'" :FactoryName="'gender'"   v-model ="RequestData.gender"  
                                :FactorySelectOptions="['boy','girl']"
                                :FactoryErrors="(  ServerReaponse && Array.isArray( ServerReaponse.errors.gender )   ) ? ServerReaponse.errors.gender : null"
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
import Model                from 'AdminModels/SubUser';
import UserModel            from 'AdminModels/User';
import AccessoryModel        from 'AdminModels/Accessory';
import AvatarModel        from 'AdminModels/Avatar';

import validation     from 'AdminValidations/SubUser';
import InputsFactory     from 'AdminPartials/Components/Inputs/InputsFactory.vue'     ;

    export default    {
        name:'SubUserCreate',
        components : { InputsFactory } ,

        async mounted() {
            this.GetUsers();
            this.GetAccessories();
            this.GetAvatars();
        },
        data( ) { return {
            TableName :'SubUser',
            TablePageName :'SubUser.ShowAll',

            UserRows :null,
            AccessoryRows   :null,
            AvatarRows   :null,

            ServerReaponse : {
                errors      : {
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
                name            : null,
                age             : null,
                points          : null,
                user_id         : null,
                gender          : null,

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

            DeleteErrors(){
                for (var key in this.ServerReaponse.errors) {
                    this.ServerReaponse.errors[key] = [];
                }
                this.ServerReaponse.message =null;
            },


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
                    this.ServerReaponse = null;
                    let data = await this.store()  ;
                    if(data && data.errors){
                        this.ServerReaponse = data ;
                    }else{
                        this.ReturnToTablePag();//success from server
                    }
                },
                async DetectServerError(data){
                    this.ServerReaponse = data ;//error from the server
                },
                
                async ReturnToTablePag( ) {
                    return this.$router.push({ 
                        name: this.TablePageName , 
                        query: { CurrentPage: this.$route.query.CurrentPage } 
                    })
                },
            // after send to server

            // relationship
                async GetAccessories(page){
                    this.AccessoryRows  = ( await this.AllAccessory() ).data.data;
                },
                async GetUsers(page){
                    this.UserRows  = ( await this.AllUsers() ).data.data;
                },
                async GetAvatars(page){
                    this.AvatarRows  = ( await this.AllAvatar() ).data.data;
                    console.log(this.AvatarRows);
                },
            // relationship

            // model 
                AllUsers(){
                    return  (new UserModel).all()  ;
                },
                AllAccessory(){
                    return  (new AccessoryModel).all()  ;
                },
                AllAvatar(){
                    return  (new AvatarModel).all()  ;
                },
                store(){
                    return  (new Model).store(this.RequestData)  ;
                },
            // model 

        },

    }
</script>