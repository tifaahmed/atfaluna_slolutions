<template>
		<div class="form-group">
		    <label :for="PropName">{{PropLable}}</label>
		    <input :type="'date'" :placeholder="PropPlaceholder"  v-model="data"   class="form-control" @change="change( $event.target.value )" :id="PropName"  :name="PropName"  />
		    <div>
		        <ul> 
		            <li  v-for="err in PropErrors" :key="err" class="alert alert-solid-warning">
		              {{ err }}
		            </li>
		        </ul >
		    </div>
		</div>
</template>

 
<script> 
export default {
    data( ) { return {
    	data : this.value

    } } ,
    props   : {
    	PropLable :null,
    	PropPlaceholder :null,
    	PropType  :null,
    	PropName : null,
    	PropErrors    : [] ,	
    	value :null,
    } ,
    watch   : {

    	value( ) {
    	    this.data = this.value ;
    	}
    } ,
    methods : {
        change( value ) {
        	this.$emit( 'input'  , String( this.data ) ) ;
        	this.$emit( 'change' , String( this.data ) ) ;        
        }
    } ,
} </script>