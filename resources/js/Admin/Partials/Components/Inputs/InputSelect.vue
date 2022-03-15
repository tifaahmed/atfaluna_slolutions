<template>
		<div  v-if="PropSelectOptions" class="form-group">
		    <label  class="typo__label" :for="PropName"> {{PropLable}}  </label>



			<multiselect v-model="data" 
			:label="PropSelectColumnName" 
			:track-by="PropSelectColumnName" 
			:options="PropSelectOptions ? PropSelectOptions : []" 
			:option-height="104"   
			:multiple="false"   
			 :searchable="false"
			>
				<template slot="singleLabel" slot-scope="props" >
					
					<span class="option__desc">
						<span class="option__title">
							<span > ( {{props.option.id}} ) </span>
							<img v-if="props.option[PropFactorySelectimage]" class="option__image" :src="props.option[PropFactorySelectimage]" style="width:50px">
							/
							<span :if="PropSelectColumnOptions" class="option__title" v-for="( val , key_first ) in PropSelectColumnOptions" :key="key_first"   >
								<span v-if="props.option[val] != null">- {{props.option[val]}} </span>
							</span> 
							/
							<span  :if="props.option[PropSelectForloop]" v-for="valLang in props.option[PropSelectForloop]">
								<span  v-for="valColumn in PropSelectForloopColumn">
									<span v-if="valLang[valColumn] != null">- {{valLang[valColumn]}} </span>
								</span>
							</span> 
						</span>
					</span>
				</template>
				<template slot="option" slot-scope="props">
					<div class="option__desc">
						<span > ( {{props.option.id}} ) </span>
						<img v-if="props.option[PropFactorySelectimage]" class="option__image" :src="props.option[PropFactorySelectimage]" style="width:50px">
						/
						<span :if="PropSelectColumnOptions" class="option__title" v-for="( val , key_second ) in PropSelectColumnOptions" :key="key_second"   >
							<span v-if="props.option[val] != null">- {{props.option[val]}} </span>
						</span> 
						/
						<span  :if="props.option[PropSelectForloop]" v-for="valLang in props.option[PropSelectForloop]"   >
							<span  v-for="valColumn in PropSelectForloopColumn"   >
								<span v-if="valLang[valColumn] != null">- {{valLang[valColumn]}} </span>
							</span>
						</span> 
					</div>
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
