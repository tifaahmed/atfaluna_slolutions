import HomePage      from '../Components/Pages/User/Home'    ;

import AllPage    from '../Components/Pages/User/All'    ;
import CreatePage from '../Components/Pages/User/Create' ;
import ShowPage   from '../Components/Pages/User/Show'   ;
import EditPage   from '../Components/Pages/User/Edit'   ;


export default 
    {   path : 'User' ,  component : HomePage , children : [
        { path: 'ShowAll'     , component : AllPage    , name : 'User.ShowAll'  } ,
        { path: 'Show/:id'    , component : ShowPage   , name : 'User.Show'     } ,
        { path: 'Edit/:id'    , component : EditPage   , name : 'User.Edit'     } ,
        { path: 'Create'      , component : CreatePage , name : 'User.Create'   } ,
    ] };
 