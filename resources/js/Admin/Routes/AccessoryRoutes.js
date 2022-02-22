import HomePage   from '../Components/Pages/Accessory/Home'     ;

import AllPage    from '../Components/Pages/Accessory/All'      ;
import TrashPage  from '../Components/Pages/Accessory/AllTrash' ;
import TrashShow  from '../Components/Pages/Accessory/TrashShow' ;
import CreatePage from '../Components/Pages/Accessory/Create'   ;
import ShowPage   from '../Components/Pages/Accessory/Show'     ;
import EditPage   from '../Components/Pages/Accessory/Edit'     ;


export default 
    {   path : 'Accessory' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'Accessory.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'Accessory.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'Accessory.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'Accessory.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'Accessory.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'Accessory.Create'   } ,
        ] 
    };
 