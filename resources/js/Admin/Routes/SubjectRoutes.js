import HomePage   from '../Components/Pages/Subject/Home'     ;

import AllPage    from '../Components/Pages/Subject/All'      ;
import TrashPage  from '../Components/Pages/Subject/AllTrash' ;
import TrashShow  from '../Components/Pages/Subject/TrashShow' ;
import CreatePage from '../Components/Pages/Subject/Create'   ;
import ShowPage   from '../Components/Pages/Subject/Show'     ;
import EditPage   from '../Components/Pages/Subject/Edit'     ;


export default 
    {   path : 'Subject' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'Subject.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'Subject.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'Subject.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'Subject.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'Subject.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'Subject.Create'   } ,
        ] 
    };
 