import HomePage   from '../Components/Pages/AgeGroup/Home'     ;

import AllPage    from '../Components/Pages/AgeGroup/All'      ;
import TrashPage  from '../Components/Pages/AgeGroup/AllTrash' ;
import TrashShow  from '../Components/Pages/AgeGroup/TrashShow' ;
import CreatePage from '../Components/Pages/AgeGroup/Create'   ;
import ShowPage   from '../Components/Pages/AgeGroup/Show'     ;
import EditPage   from '../Components/Pages/AgeGroup/Edit'     ;


export default 
    {   path : 'AgeGroup' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'AgeGroup.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'AgeGroup.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'AgeGroup.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'AgeGroup.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'AgeGroup.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'AgeGroup.Create'   } ,
        ] 
    };
 