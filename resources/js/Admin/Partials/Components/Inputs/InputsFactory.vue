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

		<InputMultiSelect
			v-if= "FactoryType === 'multiSelect'"
			:PropLable = "Factorylable"
			:PropType = "FactoryType"
			:PropName = "FactoryName"
			:PropErrors = "FactoryErrors"
			@change      = "change"
			v-model      = "data"
			:PropSelectOptions = "FactorySelectOptions"
			:PropSelectColumnName = "FactorySelectColumnName"

			:PropSelectForloop= "FactorySelectForloop"
			:PropSelectForloopColumn = "FactorySelectForloopColumn"

			:PropSelectColumnOptions = "FactorySelectColumnOptions"
			:PropFactorySelectimage = "FactorySelectimage"
		/> 
		<InputSelect
			v-if= "FactoryType === 'select'"
			:PropLable = "Factorylable"
			:PropType = "FactoryType"
			:PropName = "FactoryName"
			:PropErrors = "FactoryErrors"
			@change      = "change"
			v-model      = "data"
			:PropSelectOptions = "FactorySelectOptions"
			:PropSelectColumnName = "FactorySelectColumnName"
			:PropSelectColumnOptions = "FactorySelectColumnOptions"
			:PropFactorySelectimage = "FactorySelectimage"

			:PropSelectForloop= "FactorySelectForloop"
			:PropSelectForloopColumn = "FactorySelectForloopColumn"
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

import InputMultiSelect     	from 'AdminPartials/Components/Inputs/InputMultiSelect.vue'     ;
import InputSelect     	from 'AdminPartials/Components/Inputs/InputSelect.vue'     ;

import InputRadioCheckBox     	from 'AdminPartials/Components/Inputs/InputRadioCheckBox.vue'     ;

export default {

	data( ) { return {
		data : this.value,

	} } ,
	components : {
	    InputString ,InputFile,InputDate,InputMultiSelect,InputRadioCheckBox,InputSelect
		// InputForloop
		// InputMultiSelect
	} ,
	props   : {
		Factorylable : 			{  default                       : ''        } ,
		// FactoryForloop : 		{ default                    : ''        } ,
		
		FactoryPlaceholder : 	{  default                       : ''        } ,
		FactoryType : 			{  default                       : ''        } ,
		FactoryName :  			{  default                       : ''        } ,
		FactoryErrors : 		{  required : false	   } ,
		value       : 			null,
		FactorySelectOptions:   {  default                       : null        } ,
		FactorySelected:   		{  default                       : ''        } ,
		FactorySelectColumnName:{  default                       : ''        } ,
		FactorySelectimage:		{  default                       : ''        } ,
		FactorySelectColumnOptions:{  default                       : ''        } ,

		FactorySelectForloop:{  default                       : ''        } ,
		FactorySelectForloopColumn:{  default                       : ''        } ,

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

