<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::name( 'auth.') -> prefix( 'auth' ) -> group( fn ( ) => [
    Route::post( '/login' ,   'authController@login'  ) -> name( 'login' ) ,
    Route::post( '/register' ,  'authController@register' )  -> name( 'register' ) ,
]);


//auth:sanctum
//IfSuperAdminMiddleware 
//IfOwnerMiddleware 

// ->middleware('App\Http\Middleware\IfOwnerMiddleware:App\Models\User')

Route::group(['middleware' => ['auth:api']], fn ( ) : array => [
    // auth
        Route::name( 'auth.') -> prefix( 'auth' ) -> group( fn ( ) => [
            Route::post( '/logout' ,  'authController@logout' )  -> name( 'logout' ) ,
        ]),
    // user
        Route::name('user.')->prefix('/user')->group( fn ( ) : array => [
            Route::get('/'                          ,   'UserController@all'                 )->name('all'),
            Route::post(''                          ,   'UserController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'UserController@show'                )->name('show'),
            Route::get('/collection'                ,   'UserController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'UserController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'UserController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'UserController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'UserController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'UserController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'UserController@show_trash'          )->name('show_trash'),
        ]),   
    // role & permissions  //IfSuperAdmin
        // Route::group(['middleware' => ['']], fn ( ) : array => [
            // permission
                Route::name('permission.')->prefix('/permission')->group( fn ( ) : array => [
                    Route::post(''              ,'RolePermissionController\PermissionController@store'       )->name('store'),
                    Route::get('/collection'    ,'RolePermissionController\PermissionController@collection' )->name('collection'),
                    Route::DELETE('/{id}'       ,'RolePermissionController\PermissionController@destroy'    )->name('destroy'),
                ]),
            // role
                Route::name('role.')->prefix('/role')->group( fn ( ) : array => [
                    Route::get('/'              ,'RolePermissionController\RoleController@all'              )->name('all'),
                    Route::post(''              ,'RolePermissionController\RoleController@store'            )->name('store'),
                    Route::get('/collection'    ,'RolePermissionController\RoleController@collection'       )->name('collection'),
                    Route::get('/{id}/show'     ,'RolePermissionController\RoleController@show'             )->name('show'),
                    Route::DELETE('/{id}'       ,'RolePermissionController\RoleController@destroy'          )->name('destroy'),

                ]),
            // role permission user relation
                Route::name('assignRole.')->prefix('/assignRole')->group( fn ( ) : array => [
                    Route::post(''                    ,'RolePermissionController\ModelHasRoleController@store'       )->name('store'),
                    Route::post('/{id}'               ,'RolePermissionController\ModelHasRoleController@destroy'      )->name('destroy'),
                    Route::post('/{id}/destroyAll'  ,'RolePermissionController\ModelHasRoleController@destroyAll'   )->name('destroyAll'),
                ]),
                Route::name('assignPermission.')->prefix('/assignPermission')->group( fn ( ) : array => [
                    Route::post(''                  ,'RolePermissionController\ModelHasPermissionController@store' )->name('store'),
                    Route::post('/{id}'             ,'RolePermissionController\ModelHasPermissionController@destroy')->name('destroy'),
                    Route::post('/{id}/destroyAll'  ,'RolePermissionController\ModelHasPermissionController@destroyAll')->name('destroyAll'),
                ]),
                Route::name('roleHasPermissions.')->prefix('/roleHasPermissions')->group( fn ( ) : array => [
                    Route::post(''                  ,'RolePermissionController\RoleHasPermissionController@store' )->name('store'),
                    Route::post('/{id}'             ,'RolePermissionController\RoleHasPermissionController@destroy')->name('destroy'),
                    Route::post('/{id}/destroyAll'  ,'RolePermissionController\RoleHasPermissionController@destroyAll')->name('destroyAll'),
                ]),
        // ]),   
    // language
        Route::name('language.')->prefix('/language')->group( fn ( ) : array => [
            Route::get('/'              ,   'LanguageController@all'        )  ->name('all'),
            // Route::post(''              ,   'LanguageController@store'      )  ->name('store'),
            Route::get('/{id}/show'     ,   'LanguageController@show'       )  ->name('show'),
            Route::get('/collection'    ,   'LanguageController@collection' )  ->name('collection'),
            // Route::DELETE('/{id}'       ,   'LanguageController@destroy'    )  ->name('destroy'),
            Route::post('/{id}/update'  ,   'LanguageController@update'     )  ->name('update'),

        ]),
    // QuizAttempt
        Route::name('quiz-attempt.')->prefix('/quiz-attempt')->group( fn ( ) : array => [
            Route::get('/'                          ,   'QuizAttemptController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'QuizAttemptController@show'                )->name('show'),
            Route::get('/collection'                ,   'QuizAttemptController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'SubUserController@destroy'                 )->name('destroy'),
        ]),
    // Introduction
        Route::name('introduction.')->prefix('/introduction')->group( fn ( ) : array => [
            Route::get('/'                          ,   'IntroductionController@all'                 )    ->name('all'),
            Route::post(''                          ,   'IntroductionController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'IntroductionController@show'                )->name('show'),
            Route::get('/collection'                ,   'IntroductionController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'IntroductionController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'IntroductionController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'IntroductionController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'IntroductionController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'IntroductionController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'IntroductionController@show_trash'          )->name('show_trash'),
        ]),
    // IntroductionContent
        Route::name('introduction_content.')->prefix('/introduction_content')->group( fn ( ) : array => [
            Route::get('/'                          ,   'IntroductionContentController@all'                 )    ->name('all'),
            Route::post(''                          ,   'IntroductionContentController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'IntroductionContentController@show'                )->name('show'),
            Route::get('/collection'                ,   'IntroductionContentController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'IntroductionContentController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'IntroductionContentController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'IntroductionContentController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'IntroductionContentController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'IntroductionContentController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'IntroductionContentController@show_trash'          )->name('show_trash'),
        ]),
    // about_us
        Route::name('about_us.')->prefix('/about_us')->group( fn ( ) : array => [
            Route::get('/'                          ,   'AboutUsController@all'                 )    ->name('all'),
            Route::post(''                          ,   'AboutUsController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'AboutUsController@show'                )->name('show'),
            Route::get('/collection'                ,   'AboutUsController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'AboutUsController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'AboutUsController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'AboutUsController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'AboutUsController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'AboutUsController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'AboutUsController@show_trash'          )->name('show_trash'),
        ]),
    // contact_us
        Route::name('contact_us.')->prefix('/contact_us')->group( fn ( ) : array => [
            Route::get('/'                          ,   'ContactUsController@all'                 )->name('all'),
            Route::get('/{id}/show'                 ,   'ContactUsController@show'                )->name('show'),
            Route::get('/collection'                ,   'ContactUsController@collection'          )->name('collection'),
            Route::post(''                          ,   'ContactUsController@store'               )->name('store'),
            Route::DELETE('/{id}'                   ,   'ContactUsController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'ContactUsController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'ContactUsController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'ContactUsController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'ContactUsController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'ContactUsController@show_trash'          )->name('show_trash'),

        ]),
    // QuestionTag
        Route::name('question-tag.')->prefix('/question-tag')->group( fn ( ) : array => [
            Route::get('/'              ,   'QuestionTagController@all'        )  ->name('all'),
            Route::post(''              ,   'QuestionTagController@store'      )  ->name('store'),
            Route::get('/{id}/show'     ,   'QuestionTagController@show'       )  ->name('show'),
            Route::get('/collection'    ,   'QuestionTagController@collection' )  ->name('collection'),
            Route::DELETE('/{id}'       ,   'QuestionTagController@destroy'    )  ->name('destroy'),
            Route::post('/{id}/update'  ,   'QuestionTagController@update'     )  ->name('update'),

        ]),    
    // store
        Route::name('store.')->prefix('/store')->group( fn ( ) : array => [
            Route::get('/'                          ,   'StoreController@all'                 )    ->name('all'),
            Route::post(''                          ,   'StoreController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'StoreController@show'                )->name('show'),
            Route::get('/collection'                ,   'StoreController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'StoreController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'StoreController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'StoreController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'StoreController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'StoreController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'StoreController@show_trash'          )->name('show_trash'),
        ]),
    // Avatar
        Route::name('avatar.')->prefix('/avatar')->group( fn ( ) : array => [
            Route::get('/'                          ,   'AvatarController@all'                 )    ->name('all'),
            Route::post(''                          ,   'AvatarController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'AvatarController@show'                )->name('show'),
            Route::get('/collection'                ,   'AvatarController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'AvatarController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'AvatarController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'AvatarController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'AvatarController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'AvatarController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'AvatarController@show_trash'          )->name('show_trash'),
        ]),
    // age_group
        Route::name('age-group.')->prefix('/age-group')->group( fn ( ) : array => [
            Route::get('/'                          ,   'AgeGroupController@all'                 )    ->name('all'),
            Route::post(''                          ,   'AgeGroupController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'AgeGroupController@show'                )->name('show'),
            Route::get('/collection'                ,   'AgeGroupController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'AgeGroupController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'AgeGroupController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'AgeGroupController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'AgeGroupController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'AgeGroupController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'AgeGroupController@show_trash'          )->name('show_trash'),
        ]),
    // Country
        Route::name('country.')->prefix('/country')->group( fn ( ) : array => [
            Route::get('/'                          ,   'CountryController@all'                 )    ->name('all'),
            Route::post(''                          ,   'CountryController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'CountryController@show'                )->name('show'),
            Route::get('/collection'                ,   'CountryController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'CountryController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'CountryController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'CountryController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'CountryController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'CountryController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'CountryController@show_trash'          )->name('show_trash'),
        ]),
    // Government
        Route::name('government.')->prefix('/government')->group( fn ( ) : array => [
            Route::get('/'                          ,   'GovernmentController@all'                 )    ->name('all'),
            Route::post(''                          ,   'GovernmentController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'GovernmentController@show'                )->name('show'),
            Route::get('/collection'                ,   'GovernmentController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'GovernmentController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'GovernmentController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'GovernmentController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'GovernmentController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'GovernmentController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'GovernmentController@show_trash'          )->name('show_trash'),

        ]),
    // City
        Route::name('city.')->prefix('/city')->group( fn ( ) : array => [
            Route::get('/'                          ,   'CityController@all'                 )    ->name('all'),
            Route::post(''                          ,   'CityController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'CityController@show'                )->name('show'),
            Route::get('/collection'                ,   'CityController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'CityController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'CityController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'CityController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'CityController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'CityController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'CityController@show_trash'          )->name('show_trash'),
        ]),
    // subscription
        Route::name('subscription.')->prefix('/subscription')->group( fn ( ) : array => [
            Route::get('/'                          ,   'SubscriptionController@all'                 )    ->name('all'),
            Route::post(''                          ,   'SubscriptionController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'SubscriptionController@show'                )->name('show'),
            Route::get('/collection'                ,   'SubscriptionController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'SubscriptionController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'SubscriptionController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'SubscriptionController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'SubscriptionController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'SubscriptionController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'SubscriptionController@show_trash'          )->name('show_trash'),
        ]),
    // accessory
        Route::name('accessory.')->prefix('/accessory')->group( fn ( ) : array => [
            Route::get('/'                          ,   'AccessoryController@all'                 )    ->name('all'),
            Route::post(''                          ,   'AccessoryController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'AccessoryController@show'                )->name('show'),
            Route::get('/collection'                ,   'AccessoryController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'AccessoryController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'AccessoryController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'AccessoryController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'AccessoryController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'AccessoryController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'AccessoryController@show_trash'          )->name('show_trash'),
        ]),
    // age
        Route::name('age.')->prefix('/age')->group( fn ( ) : array => [
            Route::get('/'                          ,   'AgeController@all'                 )    ->name('all'),
            Route::get('/{id}/show'                 ,   'AgeController@show'                )->name('show'),
            Route::get('/collection'                ,   'AgeController@collection'          )->name('collection'),
            Route::post('/{id}/update'              ,   'AgeController@update'              )->name('update'),
        ]),

    // Basic
        Route::name('basic.')->prefix('/basic')->group( fn ( ) : array => [
            Route::get('/collection'                ,   'BasicController@collection'          )  ->name('collection'),
            Route::post('/{id}/update'              ,   'BasicController@update'              )  ->name('update'),
        ]),
    // certificates
        Route::name('certificate.')->prefix('/certificate')->group( fn ( ) : array => [
            Route::get('/'                          ,   'CertificateController@all'                 )    ->name('all'),
            Route::post(''                          ,   'CertificateController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'CertificateController@show'                )->name('show'),
            Route::get('/collection'                ,   'CertificateController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'CertificateController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'CertificateController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'CertificateController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'CertificateController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'CertificateController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'CertificateController@show_trash'          )->name('show_trash'),
        ]),
    // QuizType
        Route::name('quiz-type.')->prefix('/quiz-type')->group( fn ( ) : array => [
            Route::get('/'                          ,   'QuizTypeController@all'                 )    ->name('all'),
            Route::post(''                          ,   'QuizTypeController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'QuizTypeController@show'                )->name('show'),
            Route::get('/collection'                ,   'QuizTypeController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'QuizTypeController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'QuizTypeController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'QuizTypeController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'QuizTypeController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'QuizTypeController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'QuizTypeController@show_trash'          )->name('show_trash'),
        ]),
    // LessonType
        Route::name('lesson-type.')->prefix('/lesson-type')->group( fn ( ) : array => [
            Route::get('/'                          ,   'LessonTypeController@all'                 )    ->name('all'),
            Route::post(''                          ,   'LessonTypeController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'LessonTypeController@show'                )->name('show'),
            Route::get('/collection'                ,   'LessonTypeController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'LessonTypeController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'LessonTypeController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'LessonTypeController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'LessonTypeController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'LessonTypeController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'LessonTypeController@show_trash'          )->name('show_trash'),
        ]),
    // Lesson
        Route::name('lesson.')->prefix('/lesson')->group( fn ( ) : array => [
            Route::get('/'                          ,   'LessonController@all'                 )    ->name('all'),
            Route::post(''                          ,   'LessonController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'LessonController@show'                )->name('show'),
            Route::get('/collection'                ,   'LessonController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'LessonController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'LessonController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'LessonController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'LessonController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'LessonController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'LessonController@show_trash'          )->name('show_trash'),
        ]),
    // McqAnswer
        Route::name('mcq-answer.')->prefix('/mcq-answer')->group( fn ( ) : array => [
            Route::get('/'                          ,   'McqAnswerController@all'                 )    ->name('all'),
            Route::post(''                          ,   'McqAnswerController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'McqAnswerController@show'                )->name('show'),
            Route::get('/collection'                ,   'McqAnswerController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'McqAnswerController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'McqAnswerController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'McqAnswerController@restore'             )->name('restore'),

            Route::DELETE('premanently-delete/{id}' ,   'McqAnswerController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'McqAnswerController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'McqAnswerController@show_trash'          )->name('show_trash'),
        ]),
    //McqQuestion
        Route::name('mcq-question.')->prefix('/mcq-question')->group( fn ( ) : array => [
            Route::get('/'                          ,   'McqQuestionController@all'                 )    ->name('all'),
            Route::post(''                          ,   'McqQuestionController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'McqQuestionController@show'                )->name('show'),
            Route::get('/collection'                ,   'McqQuestionController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'McqQuestionController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'McqQuestionController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'McqQuestionController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'McqQuestionController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'McqQuestionController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'McqQuestionController@show_trash'          )->name('show_trash'),
        ]),
    //Package
        Route::name('package.')->prefix('/package')->group( fn ( ) : array => [
            Route::get('/'                          ,   'PackageController@all'                 )    ->name('all'),
            Route::post(''                          ,   'PackageController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'PackageController@show'                )->name('show'),
            Route::get('/collection'                ,   'PackageController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'PackageController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'PackageController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'PackageController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'PackageController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'PackageController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'PackageController@show_trash'          )->name('show_trash'),
        ]),
    //PlayTime
        Route::name('play-time.')->prefix('/play-time')->group( fn ( ) : array => [
            Route::get('/'                          ,   'PlayTimeController@all'                 )    ->name('all'),
            Route::post(''                          ,   'PlayTimeController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'PlayTimeController@show'                )->name('show'),
            Route::get('/collection'                ,   'PlayTimeController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'PlayTimeController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'PlayTimeController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'PlayTimeController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'PlayTimeController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'PlayTimeController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'PlayTimeController@show_trash'          )->name('show_trash'),
        ]),
    //Quiz
        Route::name('quiz.')->prefix('/quiz')->group( fn ( ) : array => [
            Route::get('/'                          ,   'QuizController@all'                 )    ->name('all'),
            Route::post(''                          ,   'QuizController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'QuizController@show'                )->name('show'),
            Route::get('/collection'                ,   'QuizController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'QuizController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'QuizController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'QuizController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'QuizController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'QuizController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'QuizController@show_trash'          )->name('show_trash'),
        ]),
    //Sub_user_lesson
        Route::name('sub-user-lesson.')->prefix('/sub-user-lesson')->group( fn ( ) : array => [
            Route::get('/'                          ,   'SubUserLessonController@all'                 )    ->name('all'),
            Route::post(''                          ,   'SubUserLessonController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'SubUserLessonController@show'                )->name('show'),
            Route::get('/collection'                ,   'SubUserLessonController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'SubUserLessonController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'SubUserLessonController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'SubUserLessonController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'SubUserLessonController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'SubUserLessonController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'SubUserLessonController@show_trash'          )->name('show_trash'),
        ]),
    //Sub_user_quiz
        Route::name('sub-user-quiz.')->prefix('/sub-user-quiz')->group( fn ( ) : array => [
            Route::get('/'                          ,   'SubUserQuizController@all'                 )    ->name('all'),
            Route::post(''                          ,   'SubUserQuizController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'SubUserQuizController@show'                )->name('show'),
            Route::get('/collection'                ,   'SubUserQuizController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'SubUserQuizController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'SubUserQuizController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'SubUserQuizController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'SubUserQuizController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'SubUserQuizController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'SubUserQuizController@show_trash'          )->name('show_trash'),
        ]),
    //Sub_user
        Route::name('sub-user.')->prefix('/sub-user')->group( fn ( ) : array => [
            Route::get('/'                          ,   'SubUserController@all'                 )    ->name('all'),
            Route::post(''                          ,   'SubUserController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'SubUserController@show'                )->name('show'),
            Route::get('/collection'                ,   'SubUserController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'SubUserController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'SubUserController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'SubUserController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'SubUserController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'SubUserController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'SubUserController@show_trash'          )->name('show_trash'),
        ]),
    //Subject
        Route::name('subject.')->prefix('/subject')->group( fn ( ) : array => [
            Route::get('/'                          ,   'SubjectController@all'                 )->name('all'),
            Route::post(''                          ,   'SubjectController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'SubjectController@show'                )->name('show'),
            Route::get('/collection'                ,   'SubjectController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'SubjectController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'SubjectController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'SubjectController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'SubjectController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'SubjectController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'SubjectController@show_trash'          )->name('show_trash'),
        ]),
    //Sub-subjec
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
    //True_false_question
        Route::name('true-false-question.')->prefix('/true-false-question')->group( fn ( ) : array => [
            Route::get('/'                          ,   'TrueFalseQuestionController@all'                 )    ->name('all'),
            Route::post(''                          ,   'TrueFalseQuestionController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'TrueFalseQuestionController@show'                )->name('show'),
            Route::get('/collection'                ,   'TrueFalseQuestionController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'TrueFalseQuestionController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'TrueFalseQuestionController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'TrueFalseQuestionController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'TrueFalseQuestionController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'TrueFalseQuestionController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'TrueFalseQuestionController@show_trash'          )->name('show_trash'),
        ]),
    // User_package
        Route::name('user-package.')->prefix('/user-package')->group( fn ( ) : array => [
            Route::get('/'                          ,   'UserPackageController@all'                 )    ->name('all'),
            Route::post(''                          ,   'UserPackageController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'UserPackageController@show'                )->name('show'),
            Route::get('/collection'                ,   'UserPackageController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'UserPackageController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'UserPackageController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'UserPackageController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'UserPackageController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'UserPackageController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'UserPackageController@show_trash'          )->name('show_trash'),
        ]),
    //User_subscription
        Route::name('user-subscription.')->prefix('/user-subscription')->group( fn ( ) : array => [
            Route::get('/'                          ,   'UserSubscriptionController@all'                 )    ->name('all'),
            Route::post(''                          ,   'UserSubscriptionController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'UserSubscriptionController@show'                )->name('show'),
            Route::get('/collection'                ,   'UserSubscriptionController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'UserSubscriptionController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'UserSubscriptionController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'UserSubscriptionController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'UserSubscriptionController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'UserSubscriptionController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'UserSubscriptionController@show_trash'          )->name('show_trash'),
        ]),
           //hero
            Route::name('hero.')->prefix('/hero')->group( fn ( ) : array => [
            Route::get('/'                          ,   'HeroController@all'                 )    ->name('all'),
            Route::post(''                          ,   'HeroController@store'               )->name('store'),
            Route::get('/{id}/show'                 ,   'HeroController@show'                )->name('show'),
            Route::get('/collection'                ,   'HeroController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'HeroController@destroy'             )->name('destroy'),
            Route::post('/{id}/update'              ,   'HeroController@update'              )->name('update'),
            Route::post('/{id}/restore'             ,   'HeroController@restore'             )->name('restore'),
        
            Route::DELETE('premanently-delete/{id}' ,   'HeroController@premanently_delete'  )->name('premanently_delete'),
            Route::get('/collection-trash'          ,   'HeroController@collection_trash'    )->name('collection_trash'),
            Route::get('/{id}/show-trash'           ,   'HeroController@show_trash'          )->name('show_trash'),
        ]),
         //Friend
            Route::name('friend.')->prefix('/friend')->group( fn ( ) : array => [
                Route::get('/'                          ,   'FriendController@all'                 )    ->name('all'),
                Route::get('/{id}/show'                 ,   'FriendController@show'                )->name('show'),
                Route::get('/collection'                ,   'FriendController@collection'          )->name('collection'),
                Route::DELETE('/{id}'                   ,   'FriendController@destroy'             )->name('destroy'),
            ]),
            //Group_chat
            Route::name('group_chat.')->prefix('/group_chat')->group( fn ( ) : array => [
            Route::get('/'                          ,   'GroupChatController@all'                 )    ->name('all'),
            Route::get('/{id}/show'                 ,   'GroupChatController@show'                )->name('show'),
            Route::get('/collection'                ,   'GroupChatController@collection'          )->name('collection'),
            Route::DELETE('/{id}'                   ,   'GroupChatController@destroy'             )->name('destroy'),
        ]),
        //Massage
        Route::name('massage.')->prefix('/massage')->group( fn ( ) : array => [
            Route::get('/collection'                ,   'MassageController@collection'          )->name('collection'),
        ]),
        //Conversation
        Route::name('conversation.')->prefix('/conversation')->group( fn ( ) : array => [
            Route::get('/'                          ,   'ConversationController@all'                 )    ->name('all'),
            Route::get('/{id}/show'                 ,   'ConversationController@show'                )->name('show'),
            Route::get('/collection'                ,   'ConversationController@collection'          )->name('collection'),
        ]),
]);

