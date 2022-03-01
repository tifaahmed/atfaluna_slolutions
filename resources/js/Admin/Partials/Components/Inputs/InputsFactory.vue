<template>
	<div>
		 <InputString
		 	v-if= "FactoryType === 'string' || FactoryType === 'number' || FactoryType === 'email' || FactoryType === 'password'"
		     :PropLable = "Factorylable"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
		 />
		<InputFile
	 		v-else-if    = "FactoryType === 'file'"
			:PropLable = "Factorylable"
			:PropPlaceholder = "FactoryPlaceholder"
			:PropType = "FactoryType"
			:PropName = "FactoryName"
			:PropErrors = "FactoryErrors"
			@change      = "change"
			v-model      = "data"
		/>
		<InputDate
		 	v-if= "FactoryType === 'date'"
		     :PropLable = "Factorylable"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
		 /> 
		<InputSelect
		 	v-if= "FactoryType === 'select'"
		     :PropLable = "Factorylable"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
			 :PropSelectOptions = "FactorySelectOptions"
			 :PropSelected = "FactorySelected"
			 :PropSelectColumnName = "FactorySelectColumnName"
		/> 
		<InputMultiSelect
		 	v-if= "FactoryType === 'multiSelect'"
		     :PropLable = "Factorylable"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
			 :PropSelectOptions = "FactorySelectOptions"
			 :PropSelectColumnName = "FactorySelectColumnName"
		/> 
		<InputRadioCheckBox
		 	v-if= "FactoryType === 'radio'"
		     :PropLable = "Factorylable"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
			 :PropSelectOptions = "FactorySelectOptions"
		/> 

		 
		<!-- <InputForloop
		 	v-if= "FactoryType === 'Forloop'"
		     :PropLable = "Factorylable"
		     :PropForloop = "FactoryForloop"
		     :PropPlaceholder = "FactoryPlaceholder"
		     :PropType = "FactoryType"
		     :PropName = "FactoryName"
		     :PropErrors = "FactoryErrors"
		     @change      = "change"
		     v-model      = "data"
		 /> -->
	</div>
    
</template>


<script>
import InputString     from 'AdminPartials/Components/Inputs/InputString.vue'     ;
import InputFile     	from 'AdminPartials/Components/Inputs/InputFile.vue'     ;
// import InputForloop     	from 'AdminPartials/Components/Inputs/InputForloop.vue'     ;
import InputDate     	from 'AdminPartials/Components/Inputs/InputDate.vue'     ;
import InputSelect     	from 'AdminPartials/Components/Inputs/InputSelect.vue'     ;
import InputMultiSelect     	from 'AdminPartials/Components/Inputs/InputMultiSelect.vue'     ;
import InputRadioCheckBox     	from 'AdminPartials/Components/Inputs/InputRadioCheckBox.vue'     ;

export default {

	data( ) { return {
		data : this.value,

	} } ,
	components : {
	    InputString ,InputFile,InputDate,InputSelect,InputMultiSelect,InputRadioCheckBox
		// InputForloop
	} ,
	props   : {
		Factorylable : 			{  default                       : ''        } ,
		// FactoryForloop : 		{ default                       : ''        } ,
		
		FactoryPlaceholder : 	{  default                       : ''        } ,
		FactoryType : 			{  default                       : ''        } ,
		FactoryName :  			{  default                       : ''        } ,
		FactoryErrors : 		{  required : false	   } ,
		value       : 			null,
		FactorySelectOptions:   {  default                       : ''        } ,
		FactorySelected:   		{  default                       : ''        } ,
		FactorySelectColumnName:{  default                       : ''        } ,
		
	} ,
	watch   : {
		value( ) {
		    this.data = this.value ;
		}
	} ,
	methods : {
	    change( data ) {
	    	this.data = data
	        this.$emit( 'input'  ,  this.data   ) ;
	    }
	} 
}
</script>

