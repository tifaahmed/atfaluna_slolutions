<template>
		<div class="form-group">
		    <label :for="PropName">{{PropLable}}</label>
		    <img :src="data" style="max-width:100px" />
		    <button v-if="data" @click="removeImage">Remove image</button>

		    <input :type="PropType"     @change="AvatarInput($event)" class="form-control" :id="PropName"  :name="PropName"  />
		    <div >
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
    	data : this.value,

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
 

        AvatarInput(e){
             var files = e.target.files || e.dataTransfer.files;
                  if (!files.length)
                    return;
                  this.createImage(files[0]);
         },
        createImage(file) {
         // this.value =file;   
         this.data  =file;   
         this.$emit( 'change' ,  this.data  ) ;        
         this.$emit( 'input'  ,  this.data  ) ;

         var reader = new FileReader();
          reader.onload = (e) => {
            this.data = e.target.result;
          };
          reader.readAsDataURL(file);
         },

        removeImage: function (e) {
          this.data = '';
        }




    } ,
} </script>