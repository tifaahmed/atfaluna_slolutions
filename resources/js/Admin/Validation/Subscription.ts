import Validation    from './Validation';

export default class Subscription   extends Validation {
	public monthNumberArray        : any      = []  ;
	public childNumberArray        : any      = []  ;
	public priceArray        : any      = []  ;

	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){


 	    // month_number 
		 	this.required(RequestData.month_number,'month_number',this.monthNumberArray);
		 	this.IsNumber(RequestData.month_number,'month_number',this.monthNumberArray);
		// child_number 
		 	this.required(RequestData.child_number,'child_number',this.childNumberArray);	 
		 	this.IsNumber(RequestData.child_number,'child_number',this.childNumberArray);	 
 	    // price 
		 	this.required(RequestData.price,'price',this.priceArray);

	}
}
