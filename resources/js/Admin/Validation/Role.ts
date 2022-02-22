import Validation    from './Validation';

export default class Role   extends Validation {
	public NameArray        : any      = []  ;
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

	}
}
