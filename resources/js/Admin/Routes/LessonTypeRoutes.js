import HomePage   from '../Components/Pages/LessonType/Home'     ;

import AllPage    from '../Components/Pages/LessonType/All'      ;
import TrashPage  from '../Components/Pages/LessonType/AllTrash' ;
import TrashShow  from '../Components/Pages/LessonType/TrashShow' ;
import CreatePage from '../Components/Pages/LessonType/Create'   ;
import ShowPage   from '../Components/Pages/LessonType/Show'     ;
import EditPage   from '../Components/Pages/LessonType/Edit'     ;


export default 
    {   path : 'Quiz' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'LessonType.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'LessonType.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'LessonType.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'LessonType.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'LessonType.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'LessonType.Create'   } ,
        ] 
    };
 