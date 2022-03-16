import Validation    from './Validation';

export default class Lesson   extends Validation {
	public ImageArray         : any      = []  ;
	public PointsArray         : any      = []  ;
	//public AgeGroupArray         : any      = []  ;

	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){


	    // image 
			//this.required(RequestData.image,'image',this.ImageArray);
	    	//this.FileMoreThan(RequestData.image,'image',this.ImageArray,5000000);
	    // age_group_id 
			//this.required(RequestData.age_group_id,'age_group_id',this.AgeGroupArray);
			//this.IsNumber(RequestData.age_group_id,'age_group_id',this.AgeGroupArray);

		// points
			//this.required(RequestData.points,'points',this.PointsArray);

	}
}
