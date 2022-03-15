import HomePage   from '../Components/Pages/SubSubject/Home'     ;

import AllPage    from '../Components/Pages/SubSubject/All'      ;
import TrashPage  from '../Components/Pages/SubSubject/AllTrash' ;
import TrashShow  from '../Components/Pages/SubSubject/TrashShow' ;
import CreatePage from '../Components/Pages/SubSubject/Create'   ;
import ShowPage   from '../Components/Pages/SubSubject/Show'     ;
import EditPage   from '../Components/Pages/SubSubject/Edit'     ;


export default 
    {   path : 'Quiz' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'SubSubject.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'SubSubject.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'SubSubject.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'SubSubject.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'SubSubject.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'SubSubject.Create'   } ,
        ] 
    };
 