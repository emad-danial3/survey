<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//
//    return view('welcome');
//});
Route::get('/','Api\GeneralController@getOneSurvey');
Route::post('/checkUserEmail','Api\GeneralController@checkUserEmail');
Route::post('/getLocationSurvey','Api\GeneralController@getLocationSurvey');
Route::post('/saveSurvey','Api\GeneralController@saveSurvey');
Route::get('/checkUserEmail', function () {
    return redirect('/');
});
Route::get('/getLocationSurvey', function () {
    return redirect('/');
});
Route::get('/saveSurvey', function () {
    return redirect('/');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('/login', 'AuthController@login')->name('admin.login');
    Route::post('/login', 'AuthController@loginPost')->name('admin.login.post');
    Route::get('/logout', 'AuthController@logout')->name('admin.logout');
    Route::post('/addNewQuestion', 'PageController@addNewQuestion');
    Route::post('/saveUpdateUser', 'PageController@saveUpdateUser');
    Route::post('/addNewUser', 'PageController@addNewUser');
    Route::post('/deleteCategoryUser', 'PageController@deleteCategoryUser');
    Route::post('/deleteCategoryRow', 'PageController@deleteCategoryRow');
    Route::post('/getUsersByLocation', 'PageController@getUsersByLocation');
    Route::group(['middleware' => ['auth', 'auto-check-permission']], function () { //
        Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');

        Route::get('/admins', 'AdminController@admins')->name('admin.admins');
        Route::get('/admin/create', 'AdminController@adminCreate')->name('admin.admins.create');
        Route::post('/admin/create', 'AdminController@adminStore')->name('admin.admins.create');
        Route::get('/admin/edit/{id}', 'AdminController@adminEdit')->name('admin.admins.edit');
        Route::post('/admin/edit/{id}', 'AdminController@adminUpdate')->name('admin.admins.edit');
        Route::post('/admin/delete/{id}', 'AdminController@adminDelete')->name('admin.admins.delete');

        Route::resource('permission', 'PermissionController');


        Route::resource('role', 'RoleController')->except('destroy');
        Route::post('/admin/destroy/{id}', 'RoleController@destroy')->name('admin.admins.destroy');

        Route::get('/users', 'UserController@users')->name('admin.users');
        Route::get('/user/create', 'UserController@userCreate')->name('admin.users.create');
        Route::get('/user/posts/{id}', 'UserController@userPosts')->name('admin.users.posts');
        Route::get('/user/surveys/{id}', 'UserController@userSurveys')->name('admin.users.surveys');
        Route::post('/getUserStatistic', 'UserController@getUserStatistic')->name('admin.surveys');
        Route::post('/user/create', 'UserController@userStore')->name('admin.users.create');
        Route::get('/user/edit/{id}', 'UserController@userEdit')->name('admin.users.edit');
        Route::post('/user/edit/{id}', 'UserController@userUpdate')->name('admin.users.edit');
        Route::post('/user/delete/{id}', 'UserController@userDelete')->name('admin.users.delete');


        Route::get('/reports', 'UserSurveysController@reports')->name('admin.reports');
        Route::get('/report/show/{id}', 'UserSurveysController@reportShow')->name('admin.reports.show');
        Route::post('/report/delete/{id}', 'UserSurveysController@reportDelete')->name('admin.reports.delete');



        Route::get('/categories', 'CategoryController@categories')->name('admin.categories');
        Route::get('/category/create', 'CategoryController@categoryCreate')->name('admin.categories.create');
        Route::post('/category/create', 'CategoryController@categoryStore')->name('admin.categories.create');
        Route::get('/category/edit/{id}', 'CategoryController@categoryEdit')->name('admin.categories.edit');
        Route::post('/category/edit/{id}', 'CategoryController@categoryUpdate')->name('admin.categories.edit');
        Route::post('/category/delete/{id}', 'CategoryController@categoryDelete')->name('admin.categories.delete');

         Route::get('/questions', 'QuestionController@questions')->name('admin.questions');
        Route::get('/question/create', 'QuestionController@questionCreate')->name('admin.questions.create');
        Route::post('/question/create', 'QuestionController@questionStore')->name('admin.questions.create');
        Route::get('/question/edit/{id}', 'QuestionController@questionEdit')->name('admin.questions.edit');
        Route::post('/question/edit/{id}', 'QuestionController@questionUpdate')->name('admin.questions.edit');
        Route::post('/question/delete/{id}', 'QuestionController@questionDelete')->name('admin.questions.delete');



        Route::get('/locations', 'LocationController@locations')->name('admin.locations');
        Route::get('/location/create', 'LocationController@locationCreate')->name('admin.locations.create');
        Route::post('/location/create', 'LocationController@locationStore')->name('admin.locations.create');
        Route::get('/location/edit/{id}', 'LocationController@locationEdit')->name('admin.locations.edit');
        Route::post('/location/edit/{id}', 'LocationController@locationUpdate')->name('admin.locations.edit');
        Route::post('/location/delete/{id}', 'LocationController@locationDelete')->name('admin.locations.delete');

        Route::post('/location/disabled/{id}', 'LocationController@locationDisabled')->name('admin.locations.disabled');
        Route::post('/location/activated/{id}', 'LocationController@locationActivated')->name('admin.locations.activated');



        Route::get('/departments', 'DepartmentController@departments')->name('admin.departments');
        Route::get('/department/create', 'DepartmentController@departmentCreate')->name('admin.departments.create');
        Route::post('/department/create', 'DepartmentController@departmentStore')->name('admin.departments.create');
        Route::get('/department/edit/{id}', 'DepartmentController@departmentEdit')->name('admin.departments.edit');
        Route::post('/department/edit/{id}', 'DepartmentController@departmentUpdate')->name('admin.departments.edit');
        Route::post('/department/delete/{id}', 'DepartmentController@departmentDelete')->name('admin.departments.delete');


        Route::get('/pages', 'PageController@pages')->name('admin.pages');
        Route::get('/page/create', 'PageController@pageCreate')->name('admin.pages.create');
        Route::post('/page/create', 'PageController@pageStore')->name('admin.pages.create');
        Route::get('/page/edit/{id}', 'PageController@pageEdit')->name('admin.pages.edit');
        Route::post('/page/edit/{id}', 'PageController@pageUpdate')->name('admin.pages.edit');
         Route::get('/page/show/{id}', 'PageController@pageShow')->name('admin.pages.show');

        Route::post('/page/disabled/{id}', 'PageController@pageDisabled')->name('admin.pages.edit');
        Route::post('/page/duplicate/{id}', 'PageController@pageDuplicate')->name('admin.pages.duplicate');
        Route::post('/page/activated/{id}', 'PageController@pageActivated')->name('admin.pages.edit');
        Route::post('/page/delete/{id}', 'PageController@pageDelete')->name('admin.pages.delete');


        Route::get('/settings', 'SettingController@index')->name('settings');
        Route::post('/settings/update', 'SettingController@update')->name('settings.update');
    });
});


Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang') : '';
    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
    return back();
});


Route::group(['namespace' => 'Admin'], function () {
    Route::get("/policies", 'policiesController@index');
    Route::POST("/policies_files", 'policiesController@getDirFiles');
    Route::get("policies/list_all_files", 'policiesController@listAllFiles');
    Route::get("policies/indexing_policies", 'policiesController@indexingPolicies');
});

