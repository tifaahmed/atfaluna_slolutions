import Validation    from './Validation';

export default class Accessory   extends Validation {
	public ImageArray        : any      = []  ;
	public priceArray        : any      = []  ;
	public TypeArray        : any      = []  ;
	
	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){


	    // image 
			this.required(RequestData.image,'image',this.ImageArray);
			this.FileMoreThan(RequestData.image,'image',this.ImageArray,5000000);
	 	// price 
		 	this.required(RequestData.price,'price',this.priceArray);
		// type 
			this.required(RequestData.type,'type',this.TypeArray);

	}
}
