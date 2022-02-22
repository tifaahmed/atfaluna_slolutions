<template>
	<div class="modal" id="modalShow" >
	    <div class="modal-dialog wd-xl-400" role="document">
	        <div class="modal-content">
	            <div class="modal-body pd-20 pd-sm-40 text-center" >

	            		<ModelRows :Columns="Columns" />


	                    <div class="text-center" v-for="( column , key    )  in Columns" :key="key">
                			<TableControllers 
                				v-if="column.name == 'id'" 
                				:RowId="column.value"  
                				:CurrentPage="CurrentPage" 
            				/>
	                    </div>

	                
	            </div><!-- body -->
	        </div><!-- content -->
	    </div><!-- dialog -->
	</div>
</template>

<script>
import ModelRows     from 'AdminPartialsModal/ModelRows.vue';
import TableControllers     from 'AdminPartials/Components/Controllers/TableControllers.vue'     ;

export default {
	name:'QuickViewModal',
	components:{
			ModelRows,TableControllers
	},
	data( ) { return {
	} } ,
	props : {
	    Columns : Array,
	    CurrentPage : Number
	},
}
</script>
