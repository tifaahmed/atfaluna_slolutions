<?php
use Illuminate\Support\Facades\Route;
// middleware
    //  LocalizationMiddleware : if parameter (language) exist change lange 
    //  auth            : have to get the access token 
    //  IfAuthChild     : if parameter (sub_user_id) check if he is the child of the authenticated parent   
    //  IfSubscription  : if auth user  Subscription  not ended yet 
    //  IfPlayTime      : if child not in play time

Route::group(['middleware' => ['LocalizationMiddleware']], fn ( ) : array => [


    Route::group(['middleware' => []], fn ( ) : array => [
        // auth
        Route::name( 'auth.') -> prefix( 'auth' ,'guest','guest:api') -> group( fn ( ) => [
            Route::post( '/login' ,   'authController@login'  ) -> name( 'login' ) ,
            Route::post( '/login-social' ,   'authController@loginSocial'  ) -> name( 'loginSocial' ) ,
            Route::post( '/register' ,  'authController@register' )  -> name( 'register' ) ,    
            Route::post( '/forget-password' ,  'authController@forget_password' )  -> name( 'forget_password' ) ,  
            Route::post( '/check-pin-code' ,  'authController@check_pin_code' )  -> name( 'check_pin_code' ) ,  
        ]),
        // language
            Route::name('language.')->prefix('/language')->group( fn ( ) : array => [
                Route::get('/'              ,   'LanguageController@all'        )  ->name('all'),
                Route::get('/{id}/show'     ,   'LanguageController@show'       )  ->name('show'),
                Route::get('/collection'    ,   'LanguageController@collection' )  ->name('collection'),
            ]),
        // store
            Route::name('store.')->prefix('/store')->group( fn ( ) : array => [
                Route::get('/'                          ,   'StoreController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'StoreController@show'                )->name('show'),
                Route::get('/collection'                ,   'StoreController@collection'          )->name('collection'),
            ]),
        // Country
            Route::name('country.')->prefix('/country')->group( fn ( ) : array => [
                Route::get('/'                          ,   'CountryController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'CountryController@show'                )->name('show'),
                Route::get('/collection'                ,   'CountryController@collection'          )->name('collection'),
            ]),
        // Government
            Route::name('government.')->prefix('/government')->group( fn ( ) : array => [
                Route::get('/'                          ,   'GovernmentController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'GovernmentController@show'                )->name('show'),
                Route::get('/collection'                ,   'GovernmentController@collection'          )->name('collection'),
            ]),
        // City
            Route::name('city.')->prefix('/city')->group( fn ( ) : array => [
                Route::get('/'                          ,   'CityController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'CityController@show'                )->name('show'),
                Route::get('/collection'                ,   'CityController@collection'          )->name('collection'),
            ]),
        // about_us
            Route::name('about_us.')->prefix('/about_us')->group( fn ( ) : array => [
                Route::get('/'                          ,   'AboutUsController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'AboutUsController@show'                )->name('show'),
                Route::get('/collection'                ,   'AboutUsController@collection'          )->name('collection'),
            ]),
        // contact_us
            Route::name('contact_us.')->prefix('/contact_us')->group( fn ( ) : array => [
                Route::get('/'                          ,   'ContactUsController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'ContactUsController@show'                )->name('show'),
                Route::get('/collection'                ,   'ContactUsController@collection'          )->name('collection'),
                Route::post(''                          ,   'ContactUsController@store'               )->name('store'),
                Route::DELETE('/{id}'                   ,   'ContactUsController@destroy'             )->name('destroy'),
            ]),
        // Introduction
            Route::name('introduction.')->prefix('/introduction')->group( fn ( ) : array => [
                Route::get('/'                          ,   'IntroductionController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'IntroductionController@show'                )->name('show'),
                Route::get('/collection'                ,   'IntroductionController@collection'          )->name('collection'),
            ]),
        // IntroductionContent
            Route::name('introduction_content.')->prefix('/introduction_content')->group( fn ( ) : array => [
                Route::get('/'                          ,   'IntroductionContentController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'IntroductionContentController@show'                )->name('show'),
                Route::get('/collection'                ,   'IntroductionContentController@collection'          )->name('collection'),
            ]),
        // age
            Route::name('age.')->prefix('/age')->group( fn ( ) : array => [
                Route::get('/'                          ,   'AgeController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'AgeController@show'                )->name('show'),
                Route::get('/collection'                ,   'AgeController@collection'          )->name('collection'),
            ]),
        // Basic
            Route::name('basic.')->prefix('/basic')->group( fn ( ) : array => [
                Route::get('/{id}/show'                 ,   'BasicController@show'                )  ->name('show'),
            ]),
        // LessonType
            Route::name('lesson-type.')->prefix('/lesson-type')->group( fn ( ) : array => [
                Route::get('/'                          ,   'LessonTypeController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'LessonTypeController@show'                )->name('show'),
                Route::get('/collection'                ,   'LessonTypeController@collection'          )->name('collection'),
            ]),
        // QuizType
            Route::name('quiz-type.')->prefix('/quiz-type')->group( fn ( ) : array => [
                Route::get('/'                          ,   'QuizTypeController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'QuizTypeController@show'                )->name('show'),
                Route::get('/collection'                ,   'QuizTypeController@collection'          )->name('collection'),
            ]),
        // McqAnswer
            Route::name('mcq-answer.')->prefix('/mcq-answer')->group( fn ( ) : array => [
                Route::get('/'                          ,   'McqAnswerController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'McqAnswerController@show'                )->name('show'),
                Route::get('/collection'                ,   'McqAnswerController@collection'          )->name('collection'),
            ]),
        //McqQuestion
            Route::name('mcq-question.')->prefix('/mcq-question')->group( fn ( ) : array => [
                Route::get('/'                          ,   'McqQuestionController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'McqQuestionController@show'                )->name('show'),
                Route::get('/collection'                ,   'McqQuestionController@collection'          )->name('collection'),
            ]),  
        // language
            Route::name('language.')->prefix('/language')->group( fn ( ) : array => [
                Route::get('/'              ,   'LanguageController@all'        )  ->name('all'),
                Route::get('/{id}/show'     ,   'LanguageController@show'       )  ->name('show'),
                Route::get('/collection'    ,   'LanguageController@collection' )  ->name('collection'),
            ]),
        // store
            Route::name('store.')->prefix('/store')->group( fn ( ) : array => [
                Route::get('/'                          ,   'StoreController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'StoreController@show'                )->name('show'),
                Route::get('/collection'                ,   'StoreController@collection'          )->name('collection'),
            ]),
        // Country
            Route::name('country.')->prefix('/country')->group( fn ( ) : array => [
                Route::get('/'                          ,   'CountryController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'CountryController@show'                )->name('show'),
                Route::get('/collection'                ,   'CountryController@collection'          )->name('collection'),
            ]),
        // Government
            Route::name('government.')->prefix('/government')->group( fn ( ) : array => [
                Route::get('/'                          ,   'GovernmentController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'GovernmentController@show'                )->name('show'),
                Route::get('/collection'                ,   'GovernmentController@collection'          )->name('collection'),
            ]),
        // City
            Route::name('city.')->prefix('/city')->group( fn ( ) : array => [
                Route::get('/'                          ,   'CityController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'CityController@show'                )->name('show'),
                Route::get('/collection'                ,   'CityController@collection'          )->name('collection'),
            ]),
        // about_us
            Route::name('about_us.')->prefix('/about_us')->group( fn ( ) : array => [
                Route::get('/'                          ,   'AboutUsController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'AboutUsController@show'                )->name('show'),
                Route::get('/collection'                ,   'AboutUsController@collection'          )->name('collection'),
            ]),
        // contact_us
            Route::name('contact_us.')->prefix('/contact_us')->group( fn ( ) : array => [
                Route::get('/'                          ,   'ContactUsController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'ContactUsController@show'                )->name('show'),
                Route::get('/collection'                ,   'ContactUsController@collection'          )->name('collection'),
                Route::post(''                          ,   'ContactUsController@store'               )->name('store'),
                Route::DELETE('/{id}'                   ,   'ContactUsController@destroy'             )->name('destroy'),
            ]),
        // Introduction
            Route::name('introduction.')->prefix('/introduction')->group( fn ( ) : array => [
                Route::get('/'                          ,   'IntroductionController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'IntroductionController@show'                )->name('show'),
                Route::get('/collection'                ,   'IntroductionController@collection'          )->name('collection'),
            ]),
        // IntroductionContent
            Route::name('introduction_content.')->prefix('/introduction_content')->group( fn ( ) : array => [
                Route::get('/'                          ,   'IntroductionContentController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'IntroductionContentController@show'                )->name('show'),
                Route::get('/collection'                ,   'IntroductionContentController@collection'          )->name('collection'),
            ]),
        // age
            Route::name('age.')->prefix('/age')->group( fn ( ) : array => [
                Route::get('/'                          ,   'AgeController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'AgeController@show'                )->name('show'),
                Route::get('/collection'                ,   'AgeController@collection'          )->name('collection'),
            ]),
        // Basic
            Route::name('basic.')->prefix('/basic')->group( fn ( ) : array => [
                Route::get('/{id}/show'                 ,   'BasicController@show'                )  ->name('show'),
            ]),
        // LessonType
            Route::name('lesson-type.')->prefix('/lesson-type')->group( fn ( ) : array => [
                Route::get('/'                          ,   'LessonTypeController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'LessonTypeController@show'                )->name('show'),
                Route::get('/collection'                ,   'LessonTypeController@collection'          )->name('collection'),
            ]),
        // QuizType
            Route::name('quiz-type.')->prefix('/quiz-type')->group( fn ( ) : array => [
                Route::get('/'                          ,   'QuizTypeController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'QuizTypeController@show'                )->name('show'),
                Route::get('/collection'                ,   'QuizTypeController@collection'          )->name('collection'),
            ]),
    ]),

    Route::group(['middleware' => ['auth:api']], fn ( ) : array => [
        Route::post( 'auth/update-password' ,  'authController@update_password' )  -> name( 'update_password' ),

        //Sub_user
        Route::name('sub-user.')->prefix('/sub-user')->group( fn ( ) : array => [
            Route::get('/'              ,   'SubUserController@all'                     )->name('all'),
            Route::post(''              ,   'SubUserController@store'                   )->name('store'),
            Route::get('/{id}/show'     ,   'SubUserController@show'                    )->name('show'),
            Route::get('/collection'    ,   'SubUserController@collection'              )->name('collection'),
            Route::post('/{id}/update'  ,   'SubUserController@update'                  )->name('update'),
        ]),
    ]),


    
    Route::group(['middleware' => ['auth:api','IfAuthChild']], fn ( ) : array => [

        // subscription
        Route::name('subscription.')->prefix('/subscription')->group( fn ( ) : array => [
            Route::get('/'              ,   'SubscriptionController@all'                 )->name('all'),
            Route::get('/{id}/show'     ,   'SubscriptionController@show'                )->name('show'),
            Route::get('/collection'    ,   'SubscriptionController@collection'          )->name('collection'),
            Route::post('/attach'       ,   'SubscriptionController@attach'             )->name('attach'),
        ]),

        //PlayTime
        Route::name('play-time.')->prefix('/play-time')->group( fn ( ) : array => [
            Route::get('/'                          ,   'PlayTimeController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'PlayTimeController@show'                )->name('show'),
            Route::get('/collection'                ,   'PlayTimeController@collection'          )->name('collection'),
        
            Route::post('attatch-array'    ,   'PlayTimeController@attatchArray'          )->name('attatchArray'),
            Route::post(''               ,   'PlayTimeController@store'               )->name('store'),
        ]),  
    
        //Subject
        Route::name('subject.')->prefix('/subject')->group( fn ( ) : array => [
            Route::post('/attach'                   ,   'SubjectController@attach'              )->name('attach'),
        ]),
    ]),

    Route::group(['middleware' => ['auth:api','IfAuthChild','IfSubscription']], fn ( ) : array => [
        // User_package
        Route::name('user-package.')->prefix('/user-package')->group( fn ( ) : array => [
            Route::get('/'                          ,   'UserPackageController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'UserPackageController@show'                )->name('show'),
            Route::get('/collection'                ,   'UserPackageController@collection'          )->name('collection'),
            Route::post('/store'                    ,   'UserPackageController@store'    )->name('store'),
        ]),
    
        // QuizAttempt
        Route::name('quiz-attempt.')->prefix('/quiz-attempt')->group( fn ( ) : array => [
            Route::get('/'                          ,   'QuizAttemptController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'QuizAttemptController@show'                )->name('show'),
            Route::get('/collection'                ,   'QuizAttemptController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'SubUserController@destroy'                 )->name('destroy'),
        ]),
        //McqQuestion
        Route::name('mcq-question.')->prefix('/mcq-question')->group( fn ( ) : array => [
            Route::get('/'                          ,   'McqQuestionController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'McqQuestionController@show'                )->name('show'),
            Route::get('/collection'                ,   'McqQuestionController@collection'          )->name('collection'),
            Route::post('/attach'                   ,   'McqQuestionController@attach'              )->name('attach'),
        ]),
        //True_false_question
        Route::name('true-false-question.')->prefix('/true-false-question')->group( fn ( ) : array => [
            Route::get('/'                          ,   'TrueFalseQuestionController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'TrueFalseQuestionController@show'                )->name('show'),
            Route::get('/collection'                ,   'TrueFalseQuestionController@collection'          )->name('collection'),
            Route::post('/attach'                    ,   'TrueFalseQuestionController@attach'              )->name('attach'),
        ]),
        // quiz

        Route::name('quiz.')->prefix('/quiz')->group( fn ( ) : array => [
            Route::post('/start-quiz'                   ,   'QuizController@startQuiz'              )->name('start-quiz'),
            Route::post('/answer-question'                   ,   'QuizController@answerQuestion'              )->name('start-question'),
            Route::post('/finish-quiz'                   ,   'QuizController@finishQuiz'              )->name('finish-question'),
        ]), 
        // avatar
        Route::name('avatar.')->prefix('/avatar')->group( fn ( ) : array => [
            Route::post('/attach'            ,   'AvatarController@attach'              )->name('attach'),
            Route::post('/detach'            ,   'AvatarController@detach'              )->name('detach'),
        ]),

        // age_group
        Route::name('age-group.')->prefix('/age-group')->group( fn ( ) : array => [
            Route::get('/'                          ,   'AgeGroupController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'AgeGroupController@show'                )->name('show'),
            Route::get('/collection'                ,   'AgeGroupController@collection'          )->name('collection'),
            Route::post('/attach'                   ,   'AgeGroupController@attach'              )->name('attach'),
            Route::post('/active'                   ,   'AgeGroupController@active'              )->name('active'),
        ]),
        //auth
            Route::name( 'auth.') -> prefix( 'auth' ) -> group( fn ( ) => [
                Route::post( '/logout' ,  'authController@logout' )  -> name( 'logout' ) ,
            ]),
        // user
        Route::name('user.')->prefix('/user')->group( fn ( ) : array => [
            Route::get('/'                          ,   'UserController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'UserController@show'                )->name('show'),
            Route::get('/collection'                ,   'UserController@collection'          )->name('collection'),
            Route::post('/{id}/update'              ,   'UserController@update'              )->name('update'),
        ]), 

        // Avatar
        Route::name('avatar.')->prefix('/avatar')->group( fn ( ) : array => [
            Route::get('/'              ,   'AvatarController@all'                 )->name('all'),
            Route::get('/{id}/show'     ,   'AvatarController@show'                )->name('show'),
            Route::get('/collection'    ,   'AvatarController@collection'          )->name('collection'),
        ]),
        // accessory
        Route::name('accessory.')->prefix('/accessory')->group( fn ( ) : array => [
            Route::get('/'              ,   'AccessoryController@all'                 )->name('all'),
            Route::get('/{id}/show'     ,   'AccessoryController@show'                )->name('show'),
            Route::get('/collection'    ,   'AccessoryController@collection'          )->name('collection'),
            Route::post('/attach'        ,   'AccessoryController@attach'   )->name('attach'),
            Route::post('/detach'        ,   'AccessoryController@detach'   )->name('detach'),
        ]), 
        // Achievement
        Route::name('achievement.')->prefix('/achievement')->group( fn ( ) : array => [
            Route::get('/'              ,   'AchievementController@all'                 )->name('all'),
            Route::get('/collection'    ,   'AchievementController@collection'          )->name('collection'),
            Route::post('/attach'        ,   'AchievementController@attach'   )->name('attach'),
            Route::post('/detach'        ,   'AchievementController@detach'   )->name('detach'),
        ]),  
        // certificates
        Route::name('certificate.')->prefix('/certificate')->group( fn ( ) : array => [
            Route::get('/'              ,   'CertificateController@all'                 )->name('all'),
            Route::get('/{id}/show'     ,   'CertificateController@show'                )->name('show'),
            Route::get('/collection'    ,   'CertificateController@collection'          )->name('collection'),
            Route::post('/attach'       ,   'CertificateController@attach'   )->name('attach'),
            Route::post('/detach'       ,   'CertificateController@detach'   )->name('detach'),
        ]),   
        //Quiz
            Route::name('quiz.')->prefix('/quiz')->group( fn ( ) : array => [
                Route::get('/'                          ,   'QuizController@all'                 )->name('all'),
                Route::get('/{id}/show'                 ,   'QuizController@show'                )->name('show'),
                Route::get('/collection'                ,   'QuizController@collection'          )->name('collection'),
            ]), 
        //Sub-subject
        Route::name('sub-subject.')->prefix('/sub-subject')->group( fn ( ) : array => [
            Route::get('/'                          ,   'SubSubjectController@all'                 )->name('all'),
            Route::post(''                          ,   'SubSubjectController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'SubSubjectController@show'                )->name('show'),
            Route::get('/collection'                ,   'SubSubjectController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'SubSubjectController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'SubSubjectController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'SubSubjectController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'SubSubjectController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'SubSubjectController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'SubSubjectController@show_trash'          )->name('show_trash'),
        ]),  
        //Package
        Route::name('package.')->prefix('/package')->group( fn ( ) : array => [
            Route::get('/'                          ,   'PackageController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'PackageController@show'                )->name('show'),
            Route::get('/collection'                ,   'PackageController@collection'          )->name('collection'),
            Route::post(''                          ,   'PackageController@store'               )->name('store'),
            Route::DELETE('/{id}'                   ,   'PackageController@destroy'             )->name('destroy'),
        ]),
            //Friend
        Route::name('friend.')->prefix('/friend')->group( fn ( ) : array => [
            Route::get('/'                          ,   'FriendController@all'                 )    ->name('all'),
            Route::post(''                          ,   'FriendController@store'               )->name('store'),
            Route::get('/collection'                ,   'FriendController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'FriendController@destroy'             )->name('destroy'),
        ]),
        //Massage
        Route::name('massage.')->prefix('/massage')->group( fn ( ) : array => [
        Route::get('/'                          ,   'MassageController@all'                 )    ->name('all'),
        Route::post(''                          ,   'MassageController@store'               )->name('store'),
        Route::get('/collection'                ,   'MassageController@collection'          )->name('collection'),
        ]),
        //Conversation
        Route::name('conversation.')->prefix('/conversation')->group( fn ( ) : array => [
            Route::get('/'                          ,   'ConversationController@all'                 )    ->name('all'),
            Route::post(''                          ,   'ConversationController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'ConversationController@show'                )->name('show'),
            Route::get('/collection'                ,   'ConversationController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'ConversationController@destroy'             )->name('destroy'),
        ]),
    ]),

    Route::group(['middleware' => ['auth:api','IfAuthChild','IfSubscription','IfPlayTime']], fn ( ) : array => [
        //Subject
        Route::name('subject.')->prefix('/subject')->group( fn ( ) : array => [
            Route::get('/'                          ,   'SubjectController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'SubjectController@show'                )->name('show'),
            Route::get('/collection'                ,   'SubjectController@collection'          )->name('collection'),
        ]),
        // Lesson
        Route::name('lesson.')->prefix('/lesson')->group( fn ( ) : array => [
            Route::get('/'                          ,   'LessonController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'LessonController@show'                )->name('show'),
            Route::get('/collection'                ,   'LessonController@collection'          )->name('collection'),
            Route::post('/attach'                   ,   'LessonController@attach'              )->name('attach'),
        ]), 
        //hero
        Route::name('hero.')->prefix('/hero')->group( fn ( ) : array => [
            Route::get('/'                          ,   'HeroController@all'                 )    ->name('all'),
            Route::get('/{id}/show'                 ,   'HeroController@show'                )->name('show'),
            Route::get('/collection'                ,   'HeroController@collection'          )->name('collection'),
        ]),
        //skill
        Route::name('skill.')->prefix('/skill')->group( fn ( ) : array => [
            Route::get('/'                          ,   'SkillController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'SkillController@show'                )->name('show'),
            Route::get('/collection'                ,   'SkillController@collection'          )->name('collection'),
        ]),
        // Lesson
        Route::name('lesson.')->prefix('/lesson')->group( fn ( ) : array => [
            Route::get('/'                          ,   'LessonController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'LessonController@show'                )->name('show'),
            Route::get('/collection'                ,   'LessonController@collection'          )->name('collection'),
            Route::post('/attach'                   ,   'LessonController@attach'              )->name('attach'),
        ]), 
        //hero
        Route::name('hero.')->prefix('/hero')->group( fn ( ) : array => [
            Route::get('/'                          ,   'HeroController@all'                 )    ->name('all'),
            Route::get('/{id}/show'                 ,   'HeroController@show'                )->name('show'),
            Route::get('/collection'                ,   'HeroController@collection'          )->name('collection'),

        ]),
    ]),

    
]);
    
