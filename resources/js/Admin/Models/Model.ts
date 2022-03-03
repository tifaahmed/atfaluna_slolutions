
import Swal from 'sweetalert2'

const Toast = Swal.mixin({
   toast: true,
   position: 'top-end',
   showConfirmButton: false,
   timer: 3000,
   timerProgressBar: true,
   didOpen: (toast) => {
     toast.addEventListener('mouseenter', Swal.stopTimer)
     toast.addEventListener('mouseleave', Swal.resumeTimer)
   }
})

export default class Model {

	static catch (error ?: any) : Promise<any> {
		const err = error  
		if (err.response) {
			console.log(err.response.data);
			return  err.response.data;
		}
	}
	static getformData (formData ,RequestData ?: any) {
	for (var key in RequestData) {
	   formData.append(key, RequestData[key]);
	}
	return  formData;
	};


	static getObjectFormData(formData, data, key) {
		if ( ( typeof data === 'object' && data !== null ) || Array.isArray(data) ) {
			for ( let i in data ) {
				if ( ( typeof data[i] === 'object' && data[i] !== null ) || Array.isArray(data[i]) ) {
				 this.getObjectFormData(formData, data[i], key + '[' + i + ']');
				} else {
					formData.append(key + '[' + i + ']', data[i]);
				}
			}
		} else {
			formData.append(key, data);
		}
	}
	static ErrorNotification(message) {
		Toast.fire({
            icon: 'error',
            title: message
        })
	}
	static SuccessNotification(message) {
		Toast.fire({
            icon: 'success',
            title: message
         })
	}


}