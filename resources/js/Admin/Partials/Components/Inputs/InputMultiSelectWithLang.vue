<template>
		<div class="form-group">
		    <label  class="typo__label" :for="PropName"> {{PropLable}}  </label>



			<multiselect v-if="PropSelectOptions != 'null'" v-model="data" :label="PropSelectColumnName" :track-by="PropSelectColumnName" :options="PropSelectOptions" :option-height="104"   :multiple="true"   :taggable="true"    >
				<template slot="singleLabel" slot-scope="props" >
					
					<span class="option__desc">

 
					<span class="option__title">
						<span > ( {{props.option.id}} ) </span>
						<img v-if="props.option[PropFactorySelectimage]" class="option__image" :src="props.option[PropFactorySelectimage]" style="width:50px">
						<span   v-for="( valLang , langkey    )  in props.option.languages" :key="langkey"   >
							<span  v-for="( valColumn , columnkey    )  in PropSelectColumnLang" :key="columnkey"   >
								<span v-if="valLang[valColumn] != 'null'">- {{valLang[valColumn]}} </span>
							</span>
							<br> 
						</span> 
					</span>


					</span>
				</template>
				<template slot="option" slot-scope="props">
					<div class="option__desc">
					<span > ( {{props.option.id}} ) </span>
					<img :if="props.option[PropFactorySelectimage]" class="option__image" :src="props.option[PropFactorySelectimage]" style="width:50px">

					<span :if="props.option.languages" class="option__title" v-for="( valLang , langkey ) in props.option.languages" :key="langkey"   >
						<span  v-for="( valColumn , columnkey    )  in PropSelectColumnLang" :key="columnkey"   >
							<span v-if="valLang[valColumn] != 'null'">- {{valLang[valColumn]}} </span>
						</span>
						<br> 
					</span> 
					<span  :if="props.option[PropSelectColumnName]"> ( {{props.option[PropSelectColumnName]}} ) </span>


					</div>
				</template>
			</multiselect>
			<pre class="language-json"><code>{{ data  }}</code></pre>



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
		PropSelectColumnLang : []
		
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
