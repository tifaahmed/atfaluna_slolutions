import Axios from 'axios' ;
import jwt   from './../../../Services/jwt' ;

export default class Auth {
    routType : string = 'api' ;
    name : string = 'auth' ;
    headers  : any = 
         { 
                'Authorization': jwt.Authorization ,
                 
                 // 'localization' : 'en'
         };           
    responseType : any = 'json' ;
    async LogoutAxios() : Promise<any>  { 
          return await Axios.post( 
             '/'+this.routType+'/'+this.name+'/logout','',{ headers : {'Authorization': jwt.Authorization} }
              
         ); 
       
    }
}