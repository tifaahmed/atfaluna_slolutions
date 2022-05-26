 
import Axios from 'axios' ;
import jwt   from './../../../Services/jwt' ;
import RolePermisionServices   from './../../../Services/RolePermision' ;

export default class Router   {
    name : string = '' ;
    headers  : object = 
         { 
                'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NjQ1YTAxZS0zZTBkLTQxNzEtOTc5My02NjkwYTE5MGE0MjEiLCJqdGkiOiI0NjljYjA0YmU0NWJlZTU0MTdjMGJiYWY5NTc4ODA2OGRiMzgwNjczNTE4YTEzNGNhYjQxNTQ4MjJmYjhiZDY0ZTM2ODA1ZWUwMDY2MGVmYyIsImlhdCI6MTY1MzQ3Mjk3Ni4zNjA1NTUsIm5iZiI6MTY1MzQ3Mjk3Ni4zNjA1NTgsImV4cCI6MTY4NTAwODk3Ni4zNDk5NCwic3ViIjoiMiIsInNjb3BlcyI6W119.CgdH3KawE6nRZyDo08bm74lyvXbQtH7PT0RAG3Q-stny2kRBKcJbSJD2HoGllvlp1Cnmd6Ja73kC2crbRjbxePvwyjax-ouZQVNs5zkj0KZ6YhsLrJX8XyOWv0g0rIwZfvsPF1E9e2RSiqdtE6_FgoI2H-GdM9sdbOObwaWQB73WN_gpSi-RIbmmz1kvilNjnkDExII3acC7NsKGRGLqggZGOeIh-A-FmpgOCtxV0t7r4uk_KQ_wAd5lxbrOsNNe2iMtrr86Z-jVXTBu9RI0enB4YsLi9179gbVecEJGlaxR59asIXx4YCs15lA2Jq4-QxsOKzmyRsQO7OIsPYzf5nc0wPZ9mA7y_MADPSh1x2eFF4ugP7KR_jmrXQzxVe_VwPc2cLFYAEd7ErKfWnTn_4I46SBwLjXbNYm9TViJhIbshviBnivdZf98pgUJgWkW9bi56AjNQuYxW5URbYvvsjanTjZGLozrO7cSPVnRTuu4SBdrqAuKzUvRUbG17bmk4nJvwDn4xJMjFPTzbzdTJeKcsFMgGHFjAYd6rGK6Cx3x9L3cE7Z54C5l-O75opE7tE4j0ULi20mn1zclgFilqAV6QLodSLm9gFoHpwm5xYlLsBa_bORRccEFAxNAQygU0BE7woftS86ngkvnaDR6xdD1OfJcepRdCV56_bvqWEs' ,
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
      console.log(jwt) ;
      console.log(11111) ;
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
      console.log(jwt) ;
      console.log(11111) ;      
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

      