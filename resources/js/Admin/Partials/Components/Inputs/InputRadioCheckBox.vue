<template>
		<div class="form-group">
		    <label >{{PropLable}}</label> <br>

			<div v-for="( option    , itemkey )  in PropSelectOptions" :key="itemkey"  class="form-check form-check-inline" >
				<input type="radio"    @change="change( $event.target.value )" class="form-check-input"
						:id="option"
						:name="PropName"
						v-model="data"
						:checked="option == data"
       					:value="option"
				/>
				<label :for="option" class="form-check-label">{{option}}</label>
			</div>
		    <div>
		        <ul  > 
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
        PropSelectOptions : null,

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