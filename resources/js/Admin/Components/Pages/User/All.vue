<template>
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mg-b-0 text-md-nowrap">
                            <thead> 
                                <tr> 
                                    <th 
                                        v-for="( Column , key    ) in Columns    " 
                                        :key="key   " 
                                        v-text="Column.header" 
                                    /> 
                                    <th  v-text="'controller'" />
                                </tr> 
                            </thead>
                            <tbody>
                                <tr v-for="( row    , rowkey ) in TableRows.data " :key="rowkey" >
                                    <td  v-for="( column , key    )  in Columns" :key="key" class="teeee" >
                                        <ColumsIndex  
                                            :ValueColumn="row[column.name]"   
                                            :typeColumn="column.type" 
                                            :LoopOnColumn="column.LoopOnColumn"
                                            @SendRowData ="SendRowData(row)"  
                                        />
                                    </td>
                                     
                                    <td>
                                        <TableControllers 
                                            :RowId="row.id" 
                                            :CurrentPage="TableRows.meta ? TableRows.meta.current_page: 1" 
                                            @SendRowData="SendRowData(row)"
                                        />
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <pagination 
                         v-if="TableRows" 
                         :size="'large'" 
                         :show-disabled="true" 
                         :limit="5" 
                         :data="TableRows" 
                         @pagination-change-page="initial"
                       
                         >
                            <span slot="prev-nav" >  Prev </span>
                            <span slot="next-nav" > Next  </span>
                        </pagination>
                        <ModalIndex  
                            :Columns="Columns" 
                            :TableRows="TableRows" 
                            @DeleteRowButton="DeleteRowButton"
                            :CurrentPage="TableRows.meta ? TableRows.meta.current_page: 1" 
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserModel     from 'AdminModels/User';

import pagination           from 'laravel-vue-pagination';
import ModalIndex           from 'AdminPartialsModal/MainModel.vue'     ;
import TableControllers     from 'AdminPartials/Components/Controllers/TableControllers.vue'     ;
import ColumsIndex          from 'AdminPartials/Components/colums/ColumsIndex.vue'     ;

export default {
    name:"UserAll",
    components:{
        pagination,ModalIndex,TableControllers,ColumsIndex
    },

    data( ) { return {
        TableName :'User',

        TableRows  : {},
        Columns :  [
                { type: 'Router'    ,header : 'id'       , name : 'id'     , value : null  } ,
                { type: 'String'    ,header : 'name'     , name : 'name'   , value : null  } ,
                { type: 'Image'     ,header : 'avatar'   , name : 'avatar' , value : null  } ,
                { type: 'String'    ,header : 'email'    , name : 'email'  , value : null  } ,
                { type: 'String'    ,header : 'phone'    , name : 'phone'  , value : null  } ,
                { type: 'Forloop'   ,header : 'roles'    , name : 'UserRoles'    , value : null  , LoopOnColumn :['name']} ,
                { type: 'Object'    ,header : 'country'  , name : "country"      , value : null  , LoopOnColumn :['name','code']} ,

            ],
        PerPage  : 10
    } },

    mounted() {
        this.initial( this.$route.query.CurrentPage );
    },

    methods : {
        async initial(page){
            this.TableRows  = ( await this.Collection(page) ).data
        },

        // model 
            Collection(page = 1){
                return  (new UserModel).collection(page,this.PerPage)  ;
            },
            Delete(id){
                return (new UserModel).deleteRow(id)  ;
            },
        // model 

        async DeleteRowButton(page,id){
            let  data = await this.Delete(id);
            await this.initial(page);
            this.CloseModal();
        },

        // modal
        SendRowData(row){
            this.Columns.forEach(function (SingleRow) {
                SingleRow.value = row[SingleRow.name] ;
            });
        },
        CloseModal(){
            var button = document.getElementById("close");
            button.click();
        },
        // modal



    }

}
</script>