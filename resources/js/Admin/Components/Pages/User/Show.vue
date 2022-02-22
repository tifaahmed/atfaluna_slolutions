<template>
    <div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <tbody>
                                <tr  v-for="( column , key    )  in Columns" :key="key" class="teeee" >
                                    <th class="never-hide"> {{column.name}}  </th>
                                    <td class="never-hide"> 
                                        <ColumsIndex  
                                            :ValueColumn="column.value"   
                                            :typeColumn="column.type" 
                                        />
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <router-link style="color:#fff" :to = "{ name : TableName+'.ShowAll' }" > 
                            <button type="button" class="btn btn-danger  ">
                                <i class="fas fa-arrow-left">
                                        back
                                </i>
                            </button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import UserModel     from 'AdminModels/User';
import ColumsIndex          from 'AdminPartials/Components/colums/ColumsIndex.vue'     ;

    export default {
        name:"UserShow",

        mounted() {
            this.initial();
        },
        components:{
            ColumsIndex
        },
        data( ) { return {
            TableName :'User',

            Columns :  [
                { type: 'Router' , name : 'id'     , value : null  } ,
                { type: 'String' , name : 'name'   , value : null  } ,
                { type: 'Image'  , name : 'avatar' , value : null  } ,
                { type: 'String' , name : 'email'  , value : null  } ,
                { type: 'String' , name : 'phone'  , value : null  } ,
            ],        
        } 
        } ,
        methods : {
            async initial( ) {
                var TableRows  = ( await this.Show(this.$route.params.id) ) .data.data.UserModel ;
                this.SendRowData(TableRows)

            },
            // modal
                async Show(id) {
                    return await ( (new UserModel).show(id) )
                },
            // modal
            SendRowData(row){
                this.Columns.forEach(function (SingleRow) {
                    SingleRow.value = row[SingleRow.name] ;
                });
            },

        }
    }
</script>
