import HomePage   from '../Components/Pages/McqQuestion/Home'     ;

import AllPage    from '../Components/Pages/McqQuestion/All'      ;
import TrashPage  from '../Components/Pages/McqQuestion/AllTrash' ;
import TrashShow  from '../Components/Pages/McqQuestion/TrashShow' ;
import CreatePage from '../Components/Pages/McqQuestion/Create'   ;
import ShowPage   from '../Components/Pages/McqQuestion/Show'     ;
import EditPage   from '../Components/Pages/McqQuestion/Edit'     ;


export default 
    {   path : 'McqQuestion' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'McqQuestion.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'McqQuestion.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'McqQuestion.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'McqQuestion.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'McqQuestion.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'McqQuestion.Create'   } ,
        ] 
    };
 