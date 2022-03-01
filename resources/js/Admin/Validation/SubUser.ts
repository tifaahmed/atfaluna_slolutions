import Validation    from './Validation';

export default class Country   extends Validation {
	public NameArray        : any      = []  ;
	public ImageArray       : any      = []  ;
	public CodeArray        : any      = []  ;

	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){


		// name 
			// this.required(RequestData.name,'name',this.NameArray);
	    // image 
			// this.required(RequestData.image,'image',this.ImageArray);
			// this.FileMoreThan(RequestData.image,'image',this.ImageArray,5000000);
		 // code 
			// this.required(RequestData.code,'code',this.CodeArray);
	}
}
