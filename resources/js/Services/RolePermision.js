export default class RolePermision {
	static PermissionsKey        = 'UserPermissions'  ;
	static RollesKey             = 'UserRolles'  ;
	static PermissionArray       = []  ;
	static RolleArray            = []  ;

	//3-1
	static SetPermission( PermissionsValues  ) {
	    localStorage.setItem(RolePermision.PermissionsKey, JSON.stringify(PermissionsValues));
	}

	//2-1
	static SetRoles ( RollesValues  ) {
	    localStorage.setItem(RolePermision.RollesKey, JSON.stringify(RollesValues));
	}

	//3
	static SetUserPermissions(User) {
	    var PermissionsValues = [];
	    if(User.UserPermissions){
		    for (let item of User.UserPermissions) {
		        PermissionsValues.push(item.name);
		    }
	    	RolePermision.SetPermission(PermissionsValues);
	    }
	}

	//2
	static SetUserRoles(User) {
	    var RollesValues = [];
	    if(User.UserRoles){
		    for (let item of User.UserRoles) {
		        RollesValues.push(item.name);
		    }
		    RolePermision.SetRoles(RollesValues);
	    }
	}

	//1
	static SetUserRolesPermissions(User) {
	    RolePermision.SetUserPermissions(User);
	    RolePermision.SetUserRoles(User);
	}


	static GetUserPermissions() {
		return localStorage.getItem ( RolePermision.PermissionsKey );
	}
	static GetUserRoles() {
		return localStorage.getItem ( RolePermision.RollesKey );
	}

	static  IfHasPermission(Permission) {
		var arr = []; 
		arr =  RolePermision.GetUserPermissions();
		return arr.includes(Permission);
	}


};