import HomePage      from '../../Components/Pages/RolePermissionPages/Role/Home'    ;

import AllPage    from '../../Components/Pages/RolePermissionPages/Role/All'    ;
import CreatePage from '../../Components/Pages/RolePermissionPages/Role/Create' ;
import ShowPage   from '../../Components/Pages/RolePermissionPages/Role/Show'   ;
import EditPage   from '../../Components/Pages/RolePermissionPages/Role/Edit'   ;


export default 
    {   path : 'Role' ,  component : HomePage , children : [
        { path: 'ShowAll'     , component : AllPage    , name : 'Role.ShowAll'  } ,
        { path: 'Show/:id'    , component : ShowPage   , name : 'Role.Show'     } ,
        { path: 'Edit/:id'    , component : EditPage   , name : 'Role.Edit'     } ,
        { path: 'Create'      , component : CreatePage , name : 'Role.Create'   } ,
    ] };
 