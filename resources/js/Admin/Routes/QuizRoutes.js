import HomePage   from '../Components/Pages/Quiz/Home'     ;

import AllPage    from '../Components/Pages/Quiz/All'      ;
import TrashPage  from '../Components/Pages/Quiz/AllTrash' ;
import TrashShow  from '../Components/Pages/Quiz/TrashShow' ;
import CreatePage from '../Components/Pages/Quiz/Create'   ;
import ShowPage   from '../Components/Pages/Quiz/Show'     ;
import EditPage   from '../Components/Pages/Quiz/Edit'     ;


export default 
    {   path : 'Quiz' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'Quiz.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'Quiz.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'Quiz.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'Quiz.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'Quiz.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'Quiz.Create'   } ,
        ] 
    };
 