import HomePage     from '../Components/Pages/Auth/Home'    ;

import ForgetPasswordPage  from '../Components/Pages/Auth/ForgetPassword' ;
import LoginPage           from '../Components/Pages/Auth/Login'   ;
import RegisterPage        from '../Components/Pages/Auth/Register'   ;
import ResetPasswordPage   from '../Components/Pages/Auth/ResetPassword'   ;

export default 
    { path : 'dashboard/auth' , name : 'Auth' , component : HomePage , children : [
        // { path: 'forgetPassword'         , component : ForgetPasswordPage    , name : 'Auth.ForgetPassword' } ,
        { path: 'login'                  , component : LoginPage             , name : 'Auth.Login' } ,
        // { path: 'register'               , component : RegisterPage          , name : 'Auth.Register' } ,
        // { path: 'resetPassword/:email'   , component : ResetPasswordPage     , name : 'Auth.ResetPassword' } ,
    ] };