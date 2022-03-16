import Model    from './Model';
import Router    from './Routers/McqQuestion' ;


export default class McqQuestion extends Model {
      languagesformData : string = 'languages' ;

   public async handleData(RequestData) : Promise<any>  {  
      let formData = new FormData();
      await Model.getformData(formData,RequestData) ;

         // languages
         if (RequestData.languages ) {
            let data =RequestData.languages;
            await Model.getObjectFormData(formData,data,this.languagesformData);
         }   
         // languages

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
         Model.SuccessNotification(result.data.message) ;
      } catch (error) {
         result = Model.catch(error) ;
         Model.ErrorNotification(result.data.message) ;
      }
      return  result;
   }

   protected async store(RequestData : any) : Promise<any>  {  
      let formData = await this.handleData(RequestData);

       let result : any = '';
       try {
          result   = await (new Router).StoreAxios(formData) ;
          Model.SuccessNotification(result.data.message) ;
        } catch (error) {
           result = Model.catch(error) ;
           Model.ErrorNotification(result.message) ;
        }
         return result;
   }

   protected async deleteRow(id : number) : Promise<any>  {  
      let result : any = '';
      try {
         result   = await (new Router).DeleteAxios(id) ;
         Model.SuccessNotification(result.data.message) ;
      } catch (error) {
         result = Model.catch(error) ;
         Model.ErrorNotification(result.message) ;
      }
      return result;
   }

   protected async show ( id  : number)  : Promise<any> {
      let result : any = '';
      try {
         result = await (new Router).ShowAxios(id) ;
         Model.SuccessNotification(result.data.message) ;
      } catch (error) {
         result = Model.catch(error) ;
         Model.ErrorNotification(result.message) ;
       }
       return result;
   }


   protected async update ( id  : number ,RequestData ?: any) : Promise< any > {

      let formData = await this.handleData(RequestData);

      let result : any = '';
      try {
         result =  await (new Router).UpdateAxios(id,formData) ;
         Model.SuccessNotification(result.data.message) ;
      } catch (error) {
         result = Model.catch(error) ;
         Model.ErrorNotification(result.message) ;
      }
      return result;
   }

   // trash
      protected async CollectionTrash(page : number , PerPage :number)  : Promise<Model> {  
         let result : any = '';
         try {
            result   = await (new Router).PaginateTrashAxios(page,PerPage) ;
            if(result.data.meta.to == null){
               var page = page-1;
               result = await (new Router).PaginateTrashAxios(page,PerPage) ;
            }  
            Model.SuccessNotification(result.data.message) ;
         } catch (error) {
            result = Model.catch(error) ;
            Model.ErrorNotification(result.data.message) ;
         }
         return  result;
      }
      protected async premanentlDeleteRow(id : number) : Promise<any>  {  
         let result : any = '';
         try {
            result   = await (new Router).PremanentlyDeleteAxios(id) ;
            Model.SuccessNotification(result.data.message) ;
         } catch (error) {
            result = Model.catch(error) ;
            Model.ErrorNotification(result.message) ;
         }
         return result;
      }
      protected async TrashShow ( id  : number)  : Promise<any> {
         let result : any = '';
         try {
            result = await (new Router).TrashShowAxios(id) ;
            Model.SuccessNotification(result.data.message) ;
         } catch (error) {
            result = Model.catch(error) ;
            Model.ErrorNotification(result.message) ;
         }
         return result;
      }
      protected async RstoreRow ( id  : number)  : Promise<any> {
         let result : any = '';
         try {
            result = await (new Router).RstoreRowAxios(id) ;
            Model.SuccessNotification(result.data.message) ;
         } catch (error) {
            result = Model.catch(error) ;
            Model.ErrorNotification(result.message) ;
         }
         return result;
      }
   // trash



   
}
