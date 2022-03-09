import HomePage   from '../Components/Pages/Age/Home'     ;

import AllPage    from '../Components/Pages/Age/All'      ;
import TrashPage  from '../Components/Pages/Age/AllTrash' ;
import TrashShow  from '../Components/Pages/Age/TrashShow' ;
import CreatePage from '../Components/Pages/Age/Create'   ;
import ShowPage   from '../Components/Pages/Age/Show'     ;
import EditPage   from '../Components/Pages/Age/Edit'     ;


export default 
    {   path : 'Age' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'Age.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'Age.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'Age.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'Age.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'Age.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'Age.Create'   } ,
        ] 
    };
 