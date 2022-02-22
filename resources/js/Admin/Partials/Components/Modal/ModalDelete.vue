<template>
	<div class="modal" id="ModalDelete" >
	    <div class="modal-dialog wd-xl-400" role="document">
	        <div class="modal-content">
	            <div class="modal-body pd-20 pd-sm-40 text-center" >
	
	                <h5 class="modal-title mg-b-5">do you want to delete this row  </h5>
        	    	<ModelRows :Columns="Columns" />

                     

	                <button class="btn btn-success" id="close" data-dismiss="modal" aria-label="Close">
	                    Close
	                </button>

	                <button 
	                    class="btn btn-danger-gradient" 
	                    @click="DeleteModalButton()"
	                > 
	                <i class="fas fa-trash"></i> 
	                    Delete
	                </button>                                               
	            </div><!-- body -->
	        </div><!-- content -->
	    </div><!-- dialog -->
	</div>
</template>
<script>
import ModelRows     from 'AdminPartialsModal/ModelRows.vue';

export default {
	name:'ModalDelete',

	components:{
			ModelRows
	},
	props : {
	    Columns : Array ,
	},
	methods:{
		DeleteModalButton( ){
		   this.$emit( 'DeleteButton' ) ;
		},
	}

}
</script>