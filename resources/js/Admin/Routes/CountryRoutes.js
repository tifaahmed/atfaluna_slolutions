import HomePage   from '../Components/Pages/Country/Home'     ;

import AllPage    from '../Components/Pages/Country/All'      ;
import TrashPage  from '../Components/Pages/Country/AllTrash' ;
import TrashShow  from '../Components/Pages/Country/TrashShow' ;
import CreatePage from '../Components/Pages/Country/Create'   ;
import ShowPage   from '../Components/Pages/Country/Show'     ;
import EditPage   from '../Components/Pages/Country/Edit'     ;


export default 
    {   path : 'Country' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'Country.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'Country.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'Country.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'Country.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'Country.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'Country.Create'   } ,
        ] 
    };
 