export default class Validation   {
	public errors           : object   = {}  ;
	public ServerReaponse   : object   = {}  ;

	Reaponse(){
		this.ServerReaponse['errors']  = this.errors;
		this.ServerReaponse['message'] = 'error in validation';
		return this.ServerReaponse;
	}


	required(data,name,Arraydata){
		if(data == null || !data){  // if null
		    Arraydata.push('The '+name+' field is required.');
		    this.errors[name]=Arraydata;
		}
	}
	IsNumber(data,name,Arraydata){
		if(data && isNaN(data) ){  // if null
		    Arraydata.push('The '+name+' must be a number.');
		    this.errors[name]=Arraydata;
		}
	}
	MoreThanLength(data,name,Arraydata,length){
		if(data && data.length > length){  
		    Arraydata.push('longer than '+length+' characters');
		    this.errors[name]=Arraydata;
		}
	}
	LessThanLength(data,name,Arraydata,length){
		if(data && data.length < length){ 
		    Arraydata.push('longer than '+length+' characters');
		    this.errors[name]=Arraydata;
		}
	}
	Match(data,name,Arraydata,SecoundMatchData){
		if(data && SecoundMatchData && data != SecoundMatchData){  
		    Arraydata.push('The '+name+' confirmation does not match.');
		    this.errors[name]=Arraydata;
		}
	}
	FileMoreThan(data,name,Arraydata,length){
		if(data && data.size > length ){ 
		    Arraydata.push('The '+name+' must not be greater than '+length+' bytes.');
		    this.errors[name]=Arraydata;
		}
	}
	validEmail(data,name,Arraydata) {
  		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  		if(!re.test(data)){
  			Arraydata.push(name+' is not valid.');
  			this.errors[name]=Arraydata;
  		}
	}

}