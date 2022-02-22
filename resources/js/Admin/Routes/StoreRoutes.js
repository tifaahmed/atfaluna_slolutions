import HomePage   from '../Components/Pages/Store/Home'     ;

import AllPage    from '../Components/Pages/Store/All'      ;
import TrashPage  from '../Components/Pages/Store/AllTrash' ;
import TrashShow  from '../Components/Pages/Store/TrashShow' ;
import CreatePage from '../Components/Pages/Store/Create'   ;
import ShowPage   from '../Components/Pages/Store/Show'     ;
import EditPage   from '../Components/Pages/Store/Edit'     ;


export default 
    {   path : 'Store' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'Store.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'Store.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'Store.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'Store.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'Store.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'Store.Create'   } ,
        ] 
    };
 