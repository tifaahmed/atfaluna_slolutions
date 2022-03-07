import HomePage   from '../Components/Pages/Avatar/Home'     ;

import AllPage    from '../Components/Pages/Avatar/All'      ;
import TrashPage  from '../Components/Pages/Avatar/AllTrash' ;
import TrashShow  from '../Components/Pages/Avatar/TrashShow' ;
import CreatePage from '../Components/Pages/Avatar/Create'   ;
import ShowPage   from '../Components/Pages/Avatar/Show'     ;
import EditPage   from '../Components/Pages/Avatar/Edit'     ;


export default 
    {   path : 'Avatar' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'Avatar.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'Avatar.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'Avatar.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'Avatar.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'Avatar.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'Avatar.Create'   } ,
        ] 
    };
 