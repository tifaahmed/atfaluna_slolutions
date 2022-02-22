<template>
	<div>
			<p class="mg-b-20"   v-for="( columnRow , columnRowkey    ) in Columns" :key="columnRowkey" >  
				{{columnRow.header}} :
				<ColumsIndex  
					:ValueColumn="columnRow.value"   
					:typeColumn="columnRow.type" 
					:LoopOnColumn="columnRow.LoopOnColumn"
				/>
			</p>
	</div>

</template>
<script>
import ColumsIndex          from 'AdminPartials/Components/colums/ColumsIndex.vue'     ;

export default {
		name:'ModalRows',

    components : {
        ColumsIndex
    } ,
	props : {
	    Columns : Array 
	},

}
</script>