import   RoutersAuth    from './Routers/Auth' ;
import Model    from './Model';
import jwt   from './../../Services/jwt' ;

export default class Auth   extends Model {
	protected async logout()  { 
		let result : any = '';
		try {
			result =await (new RoutersAuth).LogoutAxios() ;
		} catch (error) {
		   	result = Model.catch(error) ;
		}
		jwt.logout();

		return  result;
	}

}