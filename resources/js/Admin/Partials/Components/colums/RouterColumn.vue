<template>
   
        <button 
        @click="SendRowData" 
        class="btn btn-primary" 
        data-target="#modalShow" 
        data-toggle="modal" 
        v-text="ValueColumn" />
    
</template>
<script> 
export default {
    data( ) { return {

    } } ,
    props   : {
        ValueColumn :null,
    } ,
    methods : {
        SendRowData( ) {
            this.$emit( 'SendRowData') ;
        }
    } 
} </script>