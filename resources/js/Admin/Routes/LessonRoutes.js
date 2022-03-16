import HomePage   from '../Components/Pages/Lesson/Home'     ;

import AllPage    from '../Components/Pages/Lesson/All'      ;
import TrashPage  from '../Components/Pages/Lesson/AllTrash' ;
import TrashShow  from '../Components/Pages/Lesson/TrashShow' ;
import CreatePage from '../Components/Pages/Lesson/Create'   ;
import ShowPage   from '../Components/Pages/Lesson/Show'     ;
import EditPage   from '../Components/Pages/Lesson/Edit'     ;


export default 
    {   path : 'Lesson' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'Lesson.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'Lesson.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'Lesson.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'Lesson.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'Lesson.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'Lesson.Create'   } ,
        ] 
    };
 