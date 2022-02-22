<template>
	<div>
		<a  
		data-dismiss="modal"
		@click="SendRowData"  class=" text-danger  " data-target="#ModalDelete" data-toggle="modal" href="">
		    <i class="fas fa-trash-alt"></i>
		</a>
		<router-link 
			data-dismiss="modal"
		    class="   text-info  "  
		    :to = "{ path : 'TrashShow/'+RowId , query: { CurrentPage: CurrentPage } }" > 
		<i class="fas fa-eye"></i>
		</router-link>
		<a  
			@click="RestoreRowButton()"  class=" text-success  "   href="#">
		    <i class="fas fa-trash-restore"></i>
		</a>
		
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
	
	    RestoreRowButton(){
	        this.$emit('RestoreRowButton',this.CurrentPage,this.RowId) ;        
	    },
	    SendRowData(){
	        this.$emit('SendRowData') ;        
	    },
	}
}

</script>