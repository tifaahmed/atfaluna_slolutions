<template>
		<span class="">
            
            <span v-for="( row    , rowkey ) in PropForloop.data " :key="rowkey" >
                <span v-for="( NameRow    , Namekey ) in PropName " :key="Namekey" >
                    {{itemObjKey + 1}}
                    <div class="form-group">
                            <label :for="PropName[Namekey]">{{PropLable[Namekey] + ' ( ' + row.name + ' ) '}}</label>
                            <input :placeholder="PropLable[Namekey] + ' ( ' + row.name + ' ) '" 
                                class="form-control" 
                                @change="change( $event,itemObjKey,row.name,PropName[Namekey] )" 
                                :id="PropName[Namekey]"  
                                :name="'languages'"  
                            />
                    </div>    


                </span>
            </span>


		</span>
</template>

 
<script> 
export default {
    data( ) { return {
    	data : [
            {
                itemObjKey : 0,
                // name:null,
                // lang:null
            }
        ]

    } } ,
    props   : {
    	PropLable :null,
    	PropForloop :null,
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

        change(e,rowkey,lang,ColName) {
                console.log(e.target.value);
                console.log(rowkey);
                  
                this.data[rowkey] =  {'name':e.target.value,'ColName':ColName,'lang':lang} ;
                // this.data[rowkey].name += () ;
                // this.data[rowkey].nnlang += (lang) ;

                console.log(this.data);
                this.$emit( 'input'  ,  this.data  ) ;
                this.$emit( 'change' ,  this.data  ) ;    
            },
    } ,
} </script>