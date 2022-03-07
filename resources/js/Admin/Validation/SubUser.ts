import Validation    from './Validation';

export default class Country   extends Validation {
	public NameArray        : any      = []  ;
	public AgeArray         : any      = []  ;
	public UserArray        : any      = []  ;
	public AvatarArray       : any      = []  ;
	public GenderArray      : any      = []  ;
	

	validate(RequestData){
		this.conditions(RequestData);
		if(Object.keys(this.errors).length >0){
			return this.Reaponse();
		}
	}
	conditions(RequestData){


		// // name 
			this.required(RequestData.name,'name',this.NameArray);
		// // age 
		// 	this.required(RequestData.age,'age',this.AgeArray);
		// // user_id 
			// this.required(RequestData.user,'user_id',this.UserArray);
		// // avatar_id 
		// 	this.required(RequestData.avatar_id,'avatar_id',this.AvatarArray);
		// // gender 
		// 	this.required(RequestData.gender,'gender',this.GenderArray);

	}
}
