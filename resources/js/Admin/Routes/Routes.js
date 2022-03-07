import Adminlayout      from 'AdminFolders/Adminlayout'    ;
import Welcome      from 'AdminViews/Welcome'    ;
import RoleRoutes     from 'AdminRoutes/RolePermissionRoutes/RoleRoutes'    ;

import UsersRoutes     from 'AdminRoutes/UsersRoutes'    ;
import LanguageRoutes     from 'AdminRoutes/LanguageRoutes'    ;

import StoreRoutes          from 'AdminRoutes/StoreRoutes'    ;
import SubscriptionRoutes   from 'AdminRoutes/SubscriptionRoutes'    ;
import AccessoryRoutes      from 'AdminRoutes/AccessoryRoutes'    ;
import AgeGroupRoutes      from 'AdminRoutes/AgeGroupRoutes'    ;
import CountryRoutes      from 'AdminRoutes/CountryRoutes'    ;
import SubUserRoutes      from 'AdminRoutes/SubUserRoutes'    ;
import AvatarRoutes      from 'AdminRoutes/AvatarRoutes'    ;



export default 
{   path : '/dashboard' ,component : Adminlayout , name : 'Adminlayout' ,children : [
    {   path: ''  , component : Welcome},
    {   path: 'admin'  , component : Welcome},
    RoleRoutes,
    
    UsersRoutes,
    LanguageRoutes,

    StoreRoutes,
    SubscriptionRoutes,
    AccessoryRoutes,
    AgeGroupRoutes,
    CountryRoutes,
    SubUserRoutes,
    AvatarRoutes
] 
}

            
 
    
    
     

