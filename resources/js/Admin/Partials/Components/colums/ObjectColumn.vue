<template>
    <span>
         <span  v-for="( valLang , langkey    )  in LoopOnColumn" :key="langkey"   >
                <span v-if="ValueColumn && ValueColumn[valLang] != 'null'">- {{ValueColumn[valLang]}} </span>
        </span>
    </span>
        

</template>
<script> 
export default {
    data( ) { return {

    } } ,
    props   : {
        ValueColumn :null,
        LoopOnColumn :null,
    } ,

} </script>