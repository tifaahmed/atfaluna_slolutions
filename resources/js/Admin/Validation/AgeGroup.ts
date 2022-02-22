import Validation    from './Validation';

export default class AgeGroup   extends Validation {
	public AgeArray        : any      = []  ;

	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){


	    // age 
			this.required(RequestData.age,'age',this.AgeArray);
			this.IsNumber(RequestData.age,'age',this.AgeArray);
				
	}
}
