import Validation    from './Validation';

export default class Language   extends Validation {
	public NameArray        : any      = []  ;
	public FullNameArray        : any      = []  ;


	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){

	    // name 
	    	 this.required(RequestData.name,'name',this.NameArray);
	    	 this.MoreThanLength(RequestData.name,'name',this.NameArray,2);
	    // name 
		// full_name 
			this.required(RequestData.full_name,'full_name',this.FullNameArray);
			this.MoreThanLength(RequestData.full_name,'full_name',this.FullNameArray,20);
		// full_name 

	}
}
