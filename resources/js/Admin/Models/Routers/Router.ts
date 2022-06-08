 
import Axios from 'axios' ;
import jwt   from './../../../Services/jwt' ;
import RolePermisionServices   from './../../../Services/RolePermision' ;

export default class Router   {
    name : string = '' ;
    headers  : object = 
         { 
                'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NjFiM2I2NC1iZGI2LTQ3Y2EtODE5Ni04ZjhjMTZjZDI3NmEiLCJqdGkiOiI5OGE4ZTVlNTRjZjFiODZjNzdjMGU4NzVjMDg5NmUyNGZmZDkxNjIyMjUwMzljYzBkMDQ4YjNhZmY0ZDIwOWRjNGFmM2RjMWJlYjcxYjg1NyIsImlhdCI6MTY1NDYwNTU5My43MTIyODU5OTU0ODMzOTg0Mzc1LCJuYmYiOjE2NTQ2MDU1OTMuNzEyMjkxMDAyMjczNTU5NTcwMzEyNSwiZXhwIjoxNjg2MTQxNTkzLjcwODQ1MTk4NjMxMjg2NjIxMDkzNzUsInN1YiI6IjgyIiwic2NvcGVzIjpbXX0.o_hJRN2axTEzDqenlwcJawYO-ROJYMsfZGL-x9pwYtD9nKyNLK6Tby5xEpLf7gHdn8oNH_gQGfcH7UvdJb4FxEAWVYccnxZpVU59JcJmgH1KhMRoGlKvCV9qgN9vzEDJqWtfL9aznQ2oFv9dkFRaePDI4EJec9tYpEarQYJf_CbQHL1_MmxERbJ74LihdgT_CKBolkrFRG7R9ZLpA8ixcH4hZ5hWMHiPwGmkSvjy6RR-hNYpKEobEDwlRh__vwe8WSfExVjPOO1mY_XFqeSA3ABsGsON1atqlf_hekyYXwn-BkHcx9ORJdhp4_Z84F_jgu2bMKqaXf_9jxzT55NLdeDHyq0o71BawyQIH6Z1u6J-Zo_kwT5lyaDcAA7PmJchyiGkkmTHgmfP-esuAeSYNS2FGbkbUnZ9ESRSdRZfMogA3_cRPCSgpgmSCSkmB0tM_RtO9SR84rnGceybAjzSIbH15VDMwCQgAtVHeIN3YmCp6PBUgaBqljyNzKOdV13JiaV3nXZLhDSfmaxU0ZM8gbX9zK5g1I7zLEeKULnCupU8DXgEY9hd5d3g8JeD8tr-VDwHBI0LvtnGwW7o07XmeL2R2YmBJOEGgM4Y7X1hN3wXGmGB8699Qc_p07rMU0f7w4enaiFeoVDLYi9w7xZQnMoswbD83Vmj80MPRIXyTXU' ,
                 'Content-Type': 'multipart/form-data',
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

      