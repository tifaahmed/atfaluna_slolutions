import HomePage   from '../Components/Pages/Subscription/Home'     ;

import AllPage    from '../Components/Pages/Subscription/All'      ;
import TrashPage  from '../Components/Pages/Subscription/AllTrash' ;
import TrashShow  from '../Components/Pages/Subscription/TrashShow' ;
import CreatePage from '../Components/Pages/Subscription/Create'   ;
import ShowPage   from '../Components/Pages/Subscription/Show'     ;
import EditPage   from '../Components/Pages/Subscription/Edit'     ;


export default 
    {   path : 'Subscription' ,  component : HomePage , children : [
            { path: 'ShowAll'       , component : AllPage    , name : 'Subscription.ShowAll'  } ,
            { path: 'AllTrash'      , component : TrashPage  , name : 'Subscription.AllTrash'  } ,
            { path: 'Show/:id'      , component : ShowPage   , name : 'Subscription.Show'     } ,
            { path: 'TrashShow/:id' , component : TrashShow  , name : 'Subscription.TrashShow'     } ,
            { path: 'Edit/:id'      , component : EditPage   , name : 'Subscription.Edit'     } ,
            { path: 'Create'        , component : CreatePage , name : 'Subscription.Create'   } ,
        ] 
    };
 