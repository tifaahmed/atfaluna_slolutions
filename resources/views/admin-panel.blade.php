<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.laravel={csrfToken: '{{ csrf_token() }}'}</script>


        <!-- Favicon -->
        <link rel="icon" href="{{asset('asset/img/brand/favicon.png')}}" type="image/x-icon"/>

        <!-- Icons css -->
        <link href="{{asset('asset/css/icons.css')}}" rel="stylesheet">

        <!--  Right-sidemenu css -->
        <link href="{{asset('asset/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

        <!-- Sidemenu css -->
        <link rel="stylesheet" href="{{asset('asset/css/closed-sidemenu.css')}}">


        <!--- Style css-->
        <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('asset/css/style-dark.css')}}" rel="stylesheet">

        <!---Skinmodes css-->
        <link href="{{asset('asset/css/skin-modes.css')}}" rel="stylesheet" />

        <!--- Animations css-->
        <link href="{{asset('asset/css/animate.css')}}" rel="stylesheet">

    </head>

    <body class="main-body app sidebar-mini">
       <style type="text/css">
           /* #Tablet (Portrait)
           ================================================== */
           /* Note: Design for a width of 768px */
           /*@media all and (min-width: 768px) and (max-width: 959px) {
               td.col_1,th.col_1{
                   display:none;
                   width:0;
                   height:0;
                   opacity:0;
                   visibility: collapse;       
               } 
           }*/
           /* #Mobile (Landscape)
           ================================================== */
           /* Note: Design for a width of 600px */
           @media all and (min-width: 600px) and (max-width: 767px) {
                th:nth-child(n+5){
                   display:none;
                   width:0;
                   height:0;
                   opacity:0;
                   visibility: collapse;
               } 
                td:nth-child(n+5){
                   display:none;
                   width:0;
                   height:0;
                   opacity:0;
                   visibility: collapse;
               } 
           }
           /* #Mobile (Landscape)
           ================================================== */
           /* Note: Design for a width of 480px */
           @media all and (min-width: 480px) and (max-width: 599px) {
                th:nth-child(n+4){
                   display:none;
                   width:0;
                   height:0;
                   opacity:0;
                   visibility: collapse;
               } 
                td:nth-child(n+4){
                   display:none;
                   width:0;
                   height:0;
                   opacity:0;
                   visibility: collapse;
               }  
           }
           /*  #Mobile (Portrait)
           ================================================== */
           /* Note: Design for a width of 320px */
           @media all and (max-width: 479px) {
                th:nth-child(n+3){
                   display:none;
                   width:0;
                   height:0;
                   opacity:0;
                   visibility: collapse;
               } 
                td:nth-child(n+3){
                   display:none;
                   width:0;
                   height:0;
                   opacity:0;
                   visibility: collapse;
               }    
           }
           th:last-child ,td:last-child ,.never-hide{
                display:revert;
                width:0;
                height:100%;
                opacity:1;
                visibility: unset;
           }
           #ChatBody , #ChatList{
                overflow: scroll;
           }
       </style>
        @if (Auth::check())
            <script>
                window.Laravel = {!!json_encode([
                    'isLoggedin' => true,
                    'user' => Auth::user()
                ])!!}
            </script>
        @else
            <script>
                window.Laravel = {!!json_encode([
                    'isLoggedin' => false
                ])!!}
            </script>
        @endif
        <div id="app" class="page">
            <layout></layout>
        </div>
        <script src="{{asset('js/app.js')}}"></script>


        <!-- Loader -->
        <div id="global-loader">
            <img src="{{asset('asset/img/loader.svg')}}" class="loader-img" alt="Loader">
        </div>
        <!-- /Loader -->

 
 

 
 
        <!-- Back-to-top -->
        <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>



        <!-- JQuery min js -->
        <script src="{{asset('asset/plugins/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Bundle js -->
        <script src="{{asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Ionicons js -->
        <script src="{{asset('asset/plugins/ionicons/ionicons.js')}}"></script>

        <!-- Moment js -->
        <script src="{{asset('asset/plugins/moment/moment.js')}}"></script>

        <!-- Eva-icons js -->
        <script src="{{asset('asset/js/eva-icons.min.js')}}"></script>

        

        <!-- Sticky js -->
        <script src="{{asset('asset/js/sticky.js')}}"></script>
        <script src="{{asset('asset/js/modal-popup.js')}}"></script>

        <!-- Rating js-->

        <!-- Left-menu js-->
        <script src="{{asset('asset/plugins/side-menu/sidemenu.js')}}"></script>

        <!-- Right-sidebar js -->
        <script src="{{asset('asset/plugins/sidebar/sidebar.js')}}"></script>
        <script src="{{asset('asset/plugins/sidebar/sidebar-custom.js')}}"></script>

        <!-- eva-icons js -->
        <script src="{{asset('asset/js/eva-icons.min.js')}}"></script>

        <!-- custom js -->
        <script src="{{asset('asset/js/custom.js')}}"></script>



        <!--Internal  Chat js -->
        <!-- <script src=" asset('asset/js/chat.js') "></script> -->
        <!-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script> -->

           <!-- <script> -->
                <!-- // Enable pusher logging - don't include this in production
                // Pusher.logToConsole = true;

                // var pusher = new Pusher('f9bfb3bde63faacfba04', {
                //     cluster: 'eu',
                //     authEndpoint: "/channels/authorize",
                //     auth: { headers: { "X-CSRF-Token": "{{csrf_token()}}" } }
                // });
                // var channel = pusher.subscribe('chat.7');

                // //pending-order event
                // channel.bind('SentMessageEvent', function(data) {
                //        console.log('SentMessageEvent')   
                // }); -->
           <!-- </script> -->
        <!-- <script>
         
          window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'pusherKey' => config('broadcasting.connections.pusher.key'),
          ]) !!};
        </script> -->
    </body>
</html>