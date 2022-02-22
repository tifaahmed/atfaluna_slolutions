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
                                        v-text="Column.name" 
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
import RoleModel     from 'AdminModels/Role';

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
                { type: 'Router' , name : 'id'     , value : null  } ,
                { type: 'String' , name : 'name'   , value : null  } ,
            ],
        PerPage  : 10
    } },

    mounted() {
        this.initial( this.$route.query.CurrentPage );
    },

    methods : {
        // model 
            Collection(page = 1){
                return  (new RoleModel).collection(page,this.PerPage)  ;
            },
            Delete(id){
                return (new RoleModel).deleteRow(id)  ;
            },
        // model 


        async initial(page){
            this.TableRows  = ( await this.Collection(page) ).data
        },



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