import AdminRoutes        from './Admin/Routes/Routes'  ;
import SiteRoutes        from './Site/Routes/Routes'  ;
import AuthRoutes     from 'AdminRoutes/AuthRoutes'    ;

import layout from './layout' ;
export default { 
    mode: 'history',
    base: '/',
    routes : [
        {   
            path : '' ,component : layout , name : 'layout' ,children : 
            [
                AdminRoutes,
                AuthRoutes
            ] 
        }
    ] 
};