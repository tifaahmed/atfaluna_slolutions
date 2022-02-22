<template>
    <div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <tbody>
                                <tr  v-for="( column , key    )  in Columns" :key="key" class="teeee" >
                                    <th class="never-hide"> {{column.header}}  </th>
                                    <td class="never-hide"> 
                                        <ColumsIndex  
                                            :ValueColumn="column.value"   
                                            :typeColumn="column.type" 
                                            :LoopOnColumn="column.LoopOnColumn"
                                        />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Model     from 'AdminModels/AgeGroup';
import ColumsIndex          from 'AdminPartials/Components/colums/ColumsIndex.vue'     ;

    export default {
        name:"AgeGroupShow",

        mounted() {
            this.initial();
        },
        components:{
            ColumsIndex
        },
        data( ) { return {
            TableName :'AgeGroup',

            Columns :  [
                { type: 'Router'    ,header : 'id'                  , name : 'id'          , value : null  } ,

                { type: 'String'    ,header : 'age'                 , name : 'age'          , value : null  } ,

                ,
                { type: 'Forloop'   ,header : 'name'                , name : 'languages'    , value : null  , LoopOnColumn :['language','name']} ,
                { type: 'Date'      ,header : 'created'             , name : 'created_at'   , value : null  } ,
                { type: 'Date'      ,header : 'updated'             , name : 'updated_at'   , value : null  } ,
            ],        
        } 
        } ,
        methods : {
            async initial( ) {
                var TableRows  = ( await this.Show(this.$route.params.id) ) .data.data[0] ;
                this.SendRowData(TableRows)

            },
            // modal
                async Show(id) {
                    return await ( (new Model).show(id) )
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
