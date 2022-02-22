import Validation    from './Validation';

export default class Store   extends Validation {
	public UrlArray        : any      = []  ;
	public ImageArray        : any      = []  ;


	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){

	    // url 
	    	 this.required(RequestData.url,'url',this.UrlArray);
	    // image 
			this.required(RequestData.image,'image',this.ImageArray);
	    	this.FileMoreThan(RequestData.image,'image',this.ImageArray,5000000);

	}
}
