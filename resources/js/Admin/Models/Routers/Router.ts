 
import Axios from 'axios' ;
import jwt   from './../../../Services/jwt' ;
import RolePermisionServices   from './../../../Services/RolePermision' ;

export default class Router   {
    name : string = '' ;
    headers  : object = 
         { 
                'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NjQ1YTAxZS0zZTBkLTQxNzEtOTc5My02NjkwYTE5MGE0MjEiLCJqdGkiOiI3NjM0MmZlZjc5NzFiZThiN2UyMmE1NTdhMzQ0ZjdiODYxZTNkODljOGRjZTlmYzg0ZjhkM2U4NWEzNmU4YTM1M2U3MzA3YTY4OGQ5ZDM0MyIsImlhdCI6MTY1NDA4NzMzNS4wNDMzODgsIm5iZiI6MTY1NDA4NzMzNS4wNDMzOTEsImV4cCI6MTY4NTYyMzMzNS4wMzI2MDQsInN1YiI6IjI5Iiwic2NvcGVzIjpbXX0.DhTFeUebl_tMdBFR8hKw4k41l2QgLJKKe399J17PQAXqq0nrxvoDO4AJLLuaKouaSxxAwJnwGFYesX1gH85WsrfFjefC073Aq96YACFzjiVx2q_y1zpOQGU7Zd57tli61CPj4IQ-CeNanqUB4FYt33f1kDyieU-G85PQG8k9qEjtCLvQV1Zgg8ZR8p8B821AD3SkNcFRuFhV8y7bK04Z5etVS943xTpEKqI3p_DMyiwWzhGTCdW1yfbOv9CByaBQqbp4yadahP-r9FmZsbO88ql7TmHrJwTL9Xp36M9-WpSJPo-vXWvJwLqrUZyUL-DKzQdeOwPa4FOC_nwal33SNutG-bzx14kVCzC_Fe7FWkRxuaZO9dT05KUN4DHvRsdxm9vVphoLU6DbdfyQAjeBlWFZr3ASo6_NueTCniKWd3vNkNA8jIgnQn7pS2ja6V1U-yO-C6mIlMn7Us1Y35Zqu1K_zxHLxqCahb3b4I60Zf0jAmh-LvxwNggBYx0qYwbcU5Kxh8GhCjBLJ71ztldtzMsh1VqiS_6yFlujgqBc-X9xVZe8ANMM8PMip67mnriM0RvAjz9l4TJ2KNUz73dlwhLL1OZ6hc5AZM2KdfdCB3Fj4_ndfy5YvCr-Hzc2w8uFuxJM-BaULORSvjEc8kts2O6Eq4JxJOhdeygkle4dVKc' ,
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

      