import Model    from './Model';
import   RouterUser    from './Routers/User' ;


export default class User extends Model {
   
   protected async collection(page : number , PerPage :number)  : Promise<Model> {  
      let result : any = '';
      try {
         result   = await (new RouterUser).PaginateAxios(page,PerPage) ;
         if(result.data.meta.to == null){
            var page = page-1;
            result = await (new RouterUser).PaginateAxios(page,PerPage) ;
         }  
      } catch (error) {
         result = Model.catch(error) ;
      }
      return  result;
   }
   protected async store(RequestData ?: any) : Promise<any>  {  
      let formData = new FormData();
      var formData_data   =await Model.getformData(formData,RequestData) ;     
      let result : any = '';
      try {
         result   = await (new RouterUser).StoreAxios(formData_data) ;
       } catch (error) {
          result = Model.catch(error) ;
       }
        return result;
   }
   protected async deleteRow(id : number) : Promise<any>  {  
      let result : any = '';
      try {
         result   = await (new RouterUser).DeleteAxios(id) ;
      } catch (error) {
         result = Model.catch(error) ;
      }
      return result;
   }

   protected async show ( id  : number)  : Promise<any> {
      let result : any = '';
      try {
         result = await (new RouterUser).ShowAxios(id) ;
       } catch (error) {
          result = Model.catch(error) ;
       }
       return result;
   }
   protected async update ( id  : number ,RequestData ?: any) : Promise< any > {
      let formData = new FormData();
      var formData_data   =await Model.getformData(formData,RequestData) ;     
       let result : any = '';
      try {
           result =  await (new RouterUser).UpdateAxios(id,formData_data) ;
        } catch (error) {
          result = Model.catch(error) ;
        }
        return result;
   }



   
}
