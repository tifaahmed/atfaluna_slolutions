import Validation    from './Validation';

export default class Age   extends Validation {
	public AgeArray         : any      = []  ;
	public AgeGroupArray         : any      = []  ;
	
	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){


		// // age 
			this.required(RequestData.age,'age',this.AgeArray);
	    // age_group_id 
			this.required(RequestData.age_group_id,'age_group_id',this.AgeGroupArray);
			this.IsNumber(RequestData.age_group_id,'age_group_id',this.AgeGroupArray);

	}
}
