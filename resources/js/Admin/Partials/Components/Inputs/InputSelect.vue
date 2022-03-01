<template>
		<div class="form-group">
		    <label :for="PropName"> {{PropLable}} </label>
            <select v-model="data"    @change="change( $event.target.value )"  :name="PropName" :id="PropName"  class="form-control" >
                
                <option 
                    v-if="PropSelected" style="color:green" :value="(PropSelected  )? PropSelected.id : 1 "  selected >
                    {{ PropSelected ? PropSelected[PropSelectColumnName] : ''}}
                </option>
                <option  
                    style="font-size: 16px;"
                    v-for="( item    , itemkey ) in PropSelectOptions" :key="itemkey"  
                    v-bind:value="item ? item.id : '' "
                >
                    {{item[PropSelectColumnName]}}
                </option>
            </select>
            {{data}}

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
        PropSelected : null ,
        PropSelectColumnName : null
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