<template>
		<div  class="form-group">
		    <label  v-if="PropSelectOptions != null" class="typo__label" :for="PropName"> {{PropLable}}  </label>



			<multiselect v-model="data" 
			:label="PropSelectColumnName" 
			:track-by="PropSelectColumnName" 
			:options="PropSelectOptions ? PropSelectOptions : []" 
			:option-height="104"   
			:multiple="true"   
			:taggable="true"    
			 :searchable="false"
			>
				<template slot="singleLabel" >
					
					<span class="option__desc">
					</span>
					
				</template>
				<template slot="option" slot-scope="props">
					<span class="option__desc">
					<span > ( {{props.option.id}} ) </span> 
					
					<span :if="props.option[PropFactorySelectimage]" >
						<img  class="option__image" :src="props.option[PropFactorySelectimage]" style="width:50px">
						/
					</span>

					<span :if="props.option[PropSelectForloop]" >
						<span   v-for="( valLang , langkey    )  in props.option[PropSelectForloop]" :key="langkey"   >
							<span  v-for="valColumn in PropSelectForloopColumn">
								<span v-if="valLang[valColumn] != null">- {{valLang[valColumn]}} </span>
							</span>
							/
						</span> 
					</span>

					
					<!-- extra option -->
					<span :if="PropSelectColumnOptions" >
						<span  v-for="( val , Optionkey_ ) in PropSelectColumnOptions" :key="Optionkey_"   >
							<span v-if="props.option[val]">- {{props.option[val]}} </span>
						</span> 
						/
					</span>


					</span>
				</template>
			</multiselect>
			<!-- <pre class="language-json"><code>{{ data  }} </code></pre> -->



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
        PropSelectColumnName : null,
        PropFactorySelectimage : null,

		PropSelectColumnOptions : [],

		PropSelectForloop : null,
		PropSelectForloopColumn : [],



    } ,
    watch   : {

    	value( ) {
    	    this.data = this.value ;
    	},
        data( ) {
            this.$emit( 'input'  ,  this.data  ) ;
        	this.$emit( 'change' ,  this.data  ) ;    
    	}
    } ,



} </script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
