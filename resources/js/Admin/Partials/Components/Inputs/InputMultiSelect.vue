<template>
		<div class="form-group">
		    <label :for="PropName"> {{PropLable}}  </label>

            <!-- <multiselect v-model="data" placeholder="Search" label="name"    -->
            <!-- track-by="id" :options="SelectOptions" :multiple="true" :taggable="true" @tag="change()" ></multiselect> -->

            <!-- <multiselect v-model="data" 
            :label="'languages'" track-by="id" :options="PropSelectOptions" :multiple="true" :taggable="true"></multiselect>

            <pre class="language-json">{{ PropSelectOptions[0]['languages'][0]['name']  }}</pre> -->



			<label class="typo__label">Custom option template</label>
			<multiselect v-model="data" label="id" track-by="id" :options="PropSelectOptions" :option-height="104" :custom-label="customLabel" :multiple="true"   taggable="true"    >
				<template slot="singleLabel" slot-scope="props" >
					<img class="option__image" :src="props.option.image" style="width:50px">
					<span class="option__desc">

 


					<span  v-for="( valLang , langkey    )  in props.option.languages" :key="langkey"   >
						<span  v-for="( valLang , columnkey    )  in PropSelectColumnName" :key="columnkey"   >
							<span v-if="valColumn[valLang] != 'null'">- {{valColumn[valLang]}} </span>
						</span>
						<br> 
					</span> 


						<div ></div>
						<span class="option__title">{{props.option.languages[0]['name']}}</span>
					</span>
				</template>
				<template slot="option" slot-scope="props">
					<img class="option__image" :src="props.option.image" style="width:50px">
					<div class="option__desc">
						<span class="option__title">
							{{props.option.languages[0]['name']}}
						</span>
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
