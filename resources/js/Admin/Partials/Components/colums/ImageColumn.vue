<template>
    <a :href="ValueColumn" target="_blanck">
        <img 
        v-if="ValueColumn" 
        :src="ValueColumn" 
        style="max-width: 70px;cursor:pointer;">
    </a>
</template>
<script> 
export default {
    data( ) { return {

    } } ,
    props   : {
    	ValueColumn :null,
    } ,

} </script>