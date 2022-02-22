import HomePage     from '../Components/Pages/MainDashboard/Home'    ;

import WelcomePage    from '../Components/Pages/MainDashboard/Welcome'    ;

export default 
    { path : '/MainDashboard' , name : 'MainDashboard' , component : HomePage , children : [
        { path: '/MainDashboard/Welcome'     , component : WelcomePage    , name : 'MainDashboard.Welcome' } ,
    ] };