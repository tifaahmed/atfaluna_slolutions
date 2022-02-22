import Sitelayout     from 'SiteFolders/Sitelayout'    ;

import HomePage     from 'SiteViews/Home/Home'    ;
import ShopPage     from 'SiteViews/Shop/ShopIndex'    ;

export default 
    {   path : '/' ,component : Sitelayout , name : 'Sitelayout' ,children : [
    {    path: ''  , component : HomePage    }   ,
    {    path: 'home'  , component : HomePage    }   ,
    {    path: 'Shop' , component : ShopPage , name : 'Shop'}   ,
    ] };


    
     


