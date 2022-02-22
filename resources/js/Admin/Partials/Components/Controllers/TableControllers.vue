<template>
	<div>
		<a  
		data-dismiss="modal"
		@click="SendRowData"  class=" text-danger  " data-target="#ModalDelete" data-toggle="modal" href="">
		    <i class="fas fa-trash-alt"></i>
		</a>

		<router-link 
			data-dismiss="modal"
		    class="  text-primary "  
		    :to = "{ path : 'Edit/'+RowId , query: { CurrentPage: CurrentPage } }" > 
		<i class="far fa-edit"></i>
		     
		</router-link>

		<router-link 
			data-dismiss="modal"
		    class="   text-info  "  
		    :to = "{ path : 'Show/'+RowId , query: { CurrentPage: CurrentPage } }" > 
		<i class="fas fa-eye"></i>
		     
		</router-link>
	</div>
</template>
<script>

export default {


	data( ) { return {
	} } ,
	props : {
	    RowId : Number,
	    CurrentPage:Number,
	},
	methods : {
	

	    SendRowData(){
	        this.$emit('SendRowData') ;        
	    },
	}
}

</script>