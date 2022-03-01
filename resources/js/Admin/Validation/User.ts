import Validation    from './Validation';

export default class User   extends Validation {
	public NameArray        : any      = []  ;
	public EmailArray        : any      = []  ;
	public PasswordArray        : any      = []  ;
	public PhoneArray        : any      = []  ;
	public AvatarArray        : any      = []  ;
	// public CountryArray        : any      = []  ;

	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){

	    // // name 
	    	 this.required(RequestData.name,'name',this.NameArray);
	    	 this.MoreThanLength(RequestData.name,'name',this.NameArray,250);
	    // // name 

	    // // email 
	    	this.validEmail(RequestData.email,'email',this.EmailArray);
	    	this.required(RequestData.email,'email',this.EmailArray);
	    	this.MoreThanLength(RequestData.email,'email',this.EmailArray,250);
	    // // email 

	    // // password 
	    	this.required(RequestData.password,'password',this.PasswordArray);
	    	this.MoreThanLength(RequestData.password,'password',this.PasswordArray,15);
	    	this.LessThanLength(RequestData.password,'password',this.PasswordArray,6);

	    	this.Match(RequestData.password,'password',this.PasswordArray,RequestData.password_confirmation);
	    // // password 

	    // // password_confirmation 
	    	this.required(RequestData.password_confirmation,'password_confirmation',this.PasswordArray);
	    // // password_confirmation 

	    // // phone 
	    	this.required(RequestData.phone,'phone',this.PhoneArray);
	    	this.MoreThanLength(RequestData.phone,'phone',this.PhoneArray,15);
	    // // phone

	    // // avatar
	    	this.FileMoreThan(RequestData.avatar,'avatar',this.AvatarArray,5000000);
	    // avatar

		// // country_id 
		// this.required(RequestData.country_id,'country_id',this.CountryArray);

	}
}
