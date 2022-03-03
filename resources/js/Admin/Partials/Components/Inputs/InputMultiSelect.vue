<template>
		<div class="form-group">
		    <label  class="typo__label" :for="PropName"> {{PropLable}}  </label>
            <multiselect v-model="data" 
            	:label="PropSelectColumnName" 
				track-by="id" 
				:options="PropSelectOptions" 
				:multiple="true" 
				:taggable="true" 
				:searchable="false"
			>
			</multiselect>
			<!-- <pre class="language-json"><code>{{ data  }}</code></pre> -->
            <div>
		        <ul> 
		            <li  v-for="err in PropErrors" :key="err" class="alert alert-solid-warning">
		              {{ err }}
		            </li>
		        </ul>
		    </div>
		</div>
</template>

 
<script> 
import Multiselect from 'vue-multiselect'

export default {
    components : { Multiselect } ,

    data( ) { return {
    	data : this.value ,
    } } ,
    props   : {
    	PropLable :null,
    	PropPlaceholder :null,
    	PropType  :null,
    	PropName : null,
    	PropErrors    : [] ,	
    	value :[],
        PropSelectOptions : [],
        PropSelectColumnName : null
    } ,
    watch   : {

    	value( ) {
    	    this.data = this.value ;
    	},
        data( ) {
            this.$emit( 'input'  ,  this.data  ) ;
        	this.$emit( 'change' ,  this.data  ) ;    
    	},
    } ,

	methods: {
		customLabel ({id}) {
		// return	"<img src="+image+">";
      return id;
    }
	}

} </script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
