import HomePage      from '../Components/Pages/Language/Home'    ;

import AllPage    from '../Components/Pages/Language/All'    ;
import CreatePage from '../Components/Pages/Language/Create' ;
import ShowPage   from '../Components/Pages/Language/Show'   ;
import EditPage   from '../Components/Pages/Language/Edit'   ;


export default 
    {   path : 'Language' ,  component : HomePage , children : [
        { path: 'ShowAll'     , component : AllPage    , name : 'Language.ShowAll'  } ,
        { path: 'Show/:id'    , component : ShowPage   , name : 'Language.Show'     } ,
        { path: 'Edit/:id'    , component : EditPage   , name : 'Language.Edit'     } ,
        { path: 'Create'      , component : CreatePage , name : 'Language.Create'   } ,
    ] };
 