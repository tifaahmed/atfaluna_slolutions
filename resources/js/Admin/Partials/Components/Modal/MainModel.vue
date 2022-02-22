<template>
	<div>
		<!-- modal delete-->
		    <ModalDelete  :Columns="Columns"   @DeleteButton="DeleteButton" />
		<!-- modal delete-->

		<!-- modal QuickView-->
		    <ModelQuickView :Columns="Columns" :CurrentPage="CurrentPage"/>
		<!-- modal QuickView -->

	</div>
</template>
<script>
import ModalDelete     from 'AdminPartialsModal/ModalDelete.vue'     ;
import ModelQuickView  from 'AdminPartialsModal/ModelQuickView.vue'     ;

export default {
			name:'MainModel',

	data( ) { return {
		
	} } ,
	components:{
	    ModelQuickView,ModalDelete
	},
	props   : {
		Columns :null,
		TableRows :null,
		CurrentPage : Number
	} ,

	methods    : {
	    DeleteButton( ) {
	    	var id   ;
	    	this.Columns.forEach(function (value) {
	    		if(value.name == 'id'){
	    			id = value.value ;
	    		}
	    	});
	    	var CurrentPage = this.TableRows.meta.current_page ;
	        this.$emit( 'DeleteRowButton'  , CurrentPage, id ) ;
	    } ,
	}
}
  
</script>