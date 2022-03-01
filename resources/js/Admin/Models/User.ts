import Model    from './Model';
import   Router    from './Routers/User' ;


export default class User extends Model {
   arrayName : string = 'UserRoles' ;
   protected async all() : Promise<any>  {  
      let result : any = '';
      try {
         result   = await (new Router).AllAxios() ;
      } catch (error) {
         result = Model.catch(error) ;
         Model.ErrorNotification(result.data.message) ;
      }
      return result;
   }
   protected async collection(page : number , PerPage :number)  : Promise<Model> {  
      let result : any = '';
      try {
         result   = await (new Router).PaginateAxios(page,PerPage) ;
         if(result.data.meta.to == null){
            var page = page-1;
            result = await (new Router).PaginateAxios(page,PerPage) ;
         }  
      } catch (error) {
         result = Model.catch(error) ;
      }
      return  result;
   }
   protected async store(RequestData ?: any) : Promise<any>  {  
      let formData = new FormData();
      var formData_data   =await Model.getformData(formData,RequestData) ;
      
      if (RequestData.UserRoles ) {
         let data =RequestData.UserRoles;
         await Model.getObjectFormData(formData,data,this.arrayName);
      }   
       
      let result : any = '';
      try {
         result   = await (new Router).StoreAxios(formData_data) ;
       } catch (error) {
          result = Model.catch(error) ;
       }
        return result;
   }
   protected async deleteRow(id : number) : Promise<any>  {  
      let result : any = '';
      try {
         result   = await (new Router).DeleteAxios(id) ;
      } catch (error) {
         result = Model.catch(error) ;
      }
      return result;
   }

   protected async show ( id  : number)  : Promise<any> {
      let result : any = '';
      try {
         result = await (new Router).ShowAxios(id) ;
       } catch (error) {
          result = Model.catch(error) ;
       }
       return result;
   }
   protected async update ( id  : number ,RequestData ?: any) : Promise< any > {
      let formData = new FormData();
      var formData_data   =await Model.getformData(formData,RequestData) ;

      if (RequestData.UserRoles ) {
         let data =RequestData.UserRoles;
         await Model.getObjectFormData(formData,data,this.arrayName);
      }   

       let result : any = '';
      try {
           result =  await (new Router).UpdateAxios(id,formData_data) ;
        } catch (error) {
          result = Model.catch(error) ;
        }
        return result;
   }



   
}
