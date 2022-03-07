import Model    from './Model';
import   Router    from './Routers/User' ;


export default class User extends Model {

   public async handleData(RequestData) : Promise<any>  {  
      let formData = new FormData();
      await Model.getformData(formData,RequestData) ;

      let roles =RequestData.role_ids;
      await Model.getObjectFormData(formData,roles,'role_ids');
   
      return formData;
   }

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

       
      let formData = await this.handleData(RequestData);


      let result : any = '';
      try {
         result   = await (new Router).StoreAxios(formData) ;
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
      let formData = await this.handleData(RequestData);

       let result : any = '';
      try {
           result =  await (new Router).UpdateAxios(id,formData) ;
        } catch (error) {
          result = Model.catch(error) ;
        }
        return result;
   }



   
}
