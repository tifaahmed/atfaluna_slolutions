import HomePage     from '../Components/Pages/Auth/Home'    ;

import ForgetPasswordPage  from '../Components/Pages/Auth/ForgetPassword' ;
import LoginPage           from '../Components/Pages/Auth/Login'   ;
import RegisterPage        from '../Components/Pages/Auth/Register'   ;
import ResetPasswordPage   from '../Components/Pages/Auth/ResetPassword'   ;

export default 
    { path : '/Auth' , name : 'Auth' , component : HomePage , children : [
        { path: '/ForgetPassword'         , component : ForgetPasswordPage    , name : 'Auth.ForgetPassword' } ,
        { path: '/Login'                  , component : LoginPage             , name : 'Auth.Login' } ,
        { path: '/Register'               , component : RegisterPage          , name : 'Auth.Register' } ,
        { path: '/ResetPassword/:email'   , component : ResetPasswordPage     , name : 'Auth.ResetPassword' } ,
    ] };