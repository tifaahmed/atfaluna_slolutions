<template>
<span>
<a v-bind:href="ValueColumn" target="_blank" rel="noopener noreferrer"> LINK</a>
</span>
    
</template>
<script> 
export default {
    data( ) { return {

    } } ,
    props   : {
        ValueColumn :null,
    } ,

} </script>