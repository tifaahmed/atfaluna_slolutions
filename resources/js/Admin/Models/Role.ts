import Model    from './Model';
import   RouterRole    from './Routers/Role' ;


export default class Role extends Model {
   
   protected async collection(page : number , PerPage :number)  : Promise<Model> {  
      let result : any = '';
      try {
         result   = await (new RouterRole).PaginateAxios(page,PerPage) ;
         if(result.data.meta.to == null){
            var page = page-1;
            result = await (new RouterRole).PaginateAxios(page,PerPage) ;
         }  
      } catch (error) {
         result = Model.catch(error) ;
      }
      return  result;
   }
   protected async store(RequestData ?: any) : Promise<any>  {  
      var formData   = await Model.getformData(RequestData) ;
      let result : any = '';
      try {
         result   = await (new RouterRole).StoreAxios(formData) ;
       } catch (error) {
          result = Model.catch(error) ;
       }
        return result;
   }
   protected async deleteRow(id : number) : Promise<any>  {  
      let result : any = '';
      try {
         result   = await (new RouterRole).DeleteAxios(id) ;
      } catch (error) {
         result = Model.catch(error) ;
      }
      return result;
   }

   protected async show ( id  : number)  : Promise<any> {
      let result : any = '';
      try {
         result = await (new RouterRole).ShowAxios(id) ;
       } catch (error) {
          result = Model.catch(error) ;
       }
       return result;
   }
   protected async update ( id  : number ,RequestData ?: any) : Promise< any > {
      var formData   = await Model.getformData(RequestData) ;
      let result : any = '';
      try {
           result =  await (new RouterRole).UpdateAxios(id,formData) ;
        } catch (error) {
          result = Model.catch(error) ;
        }
        return result;
   }



   
}
