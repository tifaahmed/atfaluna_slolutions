import HomePage   from '../Components/Pages/SubUser/Home'     ;

import AllPage    from '../Components/Pages/SubUser/All'      ;
import TrashPage  from '../Components/Pages/SubUser/AllTrash' ;
import TrashShow  from '../Components/Pages/SubUser/TrashShow' ;
import CreatePage from '../Components/Pages/SubUser/Create'   ;
import ShowPage   from '../Components/Pages/SubUser/Show'     ;
import EditPage   from '../Components/Pages/SubUser/Edit'     ;


export default 
    {   path : 'SubUser' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'SubUser.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'SubUser.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'SubUser.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'SubUser.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'SubUser.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'SubUser.Create'   } ,
        ] 
    };
 