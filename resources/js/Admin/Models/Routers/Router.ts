 
import Axios from 'axios' ;
import jwt   from './../../../Services/jwt' ;
import RolePermisionServices   from './../../../Services/RolePermision' ;

export default class Router   {
    name : string = '' ;
    headers  : object = 
         { 
                'Authorization': jwt.Authorization ,
                 'Content-Type': 'multipart/form-data',
                 'localization' : 'en'
         };          
   responseType : any = 'json' ;
   routerPrefix : string = '/api/dashboard/' ;



   async IfAuth() : Promise<any>  { 
      if ( jwt.Authorization != null+ ' ' +null && !jwt.if_accessToken_expire && jwt.User) {
         return true
      }else{
         return false
      }
   } 


   async AllAxios() : Promise<any>  { 
         return  await  Axios.get( 
            this.routerPrefix+this.name ,
            { headers : this.headers , responseType : this.responseType}
         ) ;
   }

   async PaginateAxios(page : number , PerPage :number, relation_id:number = null) : Promise<any>  { 
          return await Axios.get( 
            this.routerPrefix+this.name+'/collection', 
               { 
                  headers : this.headers ,responseType : this.responseType ,       
                  params  : { 'page':page , 'PerPage':PerPage ,'relation_id':relation_id }
               } ,
         ); 
   }
   async PaginateTrashAxios(page : number , PerPage :number, relation_id:number = null) : Promise<any>  { 
      return await Axios.get( 
         this.routerPrefix+this.name+'/collection-trash', 
           { 
              headers : this.headers ,responseType : this.responseType ,       
              params  : { 'page':page , 'PerPage':PerPage ,'relation_id':relation_id }
           } ,
     ); 
}
   
   async StoreAxios(formData : any) : Promise<any>  {
       return  await Axios.post( 
         this.routerPrefix+this.name , 
          formData , 
          { headers : this.headers , responseType : this.responseType}
       );

    }

    async DeleteAxios(id : number) : Promise<any>  { 
         return  await  Axios.delete( 
            this.routerPrefix+this.name+'/'+id ,
            { headers : this.headers , responseType : this.responseType}
         ) ;
    }
    
    async PremanentlyDeleteAxios(id : number) : Promise<any>  { 
      return  await  Axios.delete( 
         this.routerPrefix+this.name+'/premanently-delete/'+id ,
         { headers : this.headers , responseType : this.responseType}
      ) ;
   }
 
   async ShowAxios(id : number) : Promise<any>  {
      return await Axios.get( 
         this.routerPrefix+this.name+'/'+id+'/show', 
         { headers : this.headers , responseType : this.responseType}
      ); 
   } 
   async TrashShowAxios(id : number) : Promise<any>  {
      return await Axios.get( 
         this.routerPrefix+this.name+'/'+id+'/show-trash', 
         { headers : this.headers , responseType : this.responseType}
      ); 
} 
   
   async UpdateAxios(id : number ,formData ?: any) : Promise<any>  { 
      return await Axios.post( 
         this.routerPrefix+this.name+'/'+id+'/update', 
         formData ,
         { headers : this.headers , responseType : this.responseType}
      ) 
   }
   async RstoreRowAxios(id : number) : Promise<any>  {
      return await Axios.post( 
         this.routerPrefix+this.name+'/'+id+'/restore', 
         { headers : this.headers , responseType : this.responseType}
      ); 
   }

   

}

      