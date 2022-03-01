<template>
    <span>
        
        <span  v-for="( valColumn , langkey    )  in ValueColumn" :key="langkey"   >
            <span  v-for="( valLang , langkey    )  in LoopOnColumn" :key="langkey"   >
                <span v-if="valColumn[valLang] != 'null'">- {{valColumn[valLang]}} </span>
            </span>
            <br> 
        </span>  
    </span>


</template>
<script> 
export default {
    data( ) { return {
    //    LoopOnColumn: ['id','name']
    } } ,

    props   : {
        ValueColumn :null,
        LoopOnColumn:null,
    } ,

} </script>