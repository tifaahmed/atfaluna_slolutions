<template >
	<span>
		<RouterColumn
		v-if="typeColumn == 'Router'"
		:ValueColumn= "ValueColumn"
		@SendRowData= "SendRowData" 
		/>
		<StringColumn
		v-else-if= "typeColumn == 'String'"
		:ValueColumn= "ValueColumn"
		/>
		<ImageColumn
		v-else-if= "typeColumn == 'Image'"
		:ValueColumn= "ValueColumn"
		/>
		<DateColumn
		v-else-if= "typeColumn == 'Date'"
		:ValueColumn= "ValueColumn"
		/>		
		<ForloopColumn
		v-else-if= "typeColumn == 'Forloop'"
		:ValueColumn= "ValueColumn"
		:LoopOnColumn =  "LoopOnColumn"
		/>
		<LinkColumn
		v-else-if= "typeColumn == 'Link'"
		:ValueColumn= "ValueColumn"
		:LoopOnColumn =  "LoopOnColumn"
		/>
	</span>

</template>
<script> 
import RouterColumn     from 'AdminPartials/Components/colums/RouterColumn.vue'     ;
import StringColumn     from 'AdminPartials/Components/colums/StringColumn.vue'     ;
import ImageColumn     	from 'AdminPartials/Components/colums/ImageColumn.vue'     ;
import DateColumn     	from 'AdminPartials/Components/colums/DateColumn.vue'     ;
import ForloopColumn    from 'AdminPartials/Components/colums/ForloopColumn.vue'     ;
import LinkColumn     	from 'AdminPartials/Components/colums/LinkColumn.vue'     ;
 
export default {
		name:'ColumsIndex',
    data( ) { return {

    } } ,
    components : {
        RouterColumn ,StringColumn,ImageColumn,DateColumn,ForloopColumn,LinkColumn
    } ,
    props   : {ValueColumn :null,LoopOnColumn:null,typeColumn :String} ,
    methods : {
        SendRowData( ) {
            this.$emit( 'SendRowData') ;
        }
    } 
} </script>