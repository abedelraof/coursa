<?php

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

Route::get('/', function (){
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(["auth" ,"CheckAdmin"])->group(function (){

//students management
    Route::get('/admin/students','StudentController@index')->name('admin.students.index');

//create students
    Route::get('/admin/students/create','StudentController@create')->name('admin.students.create');

//save students
    Route::post('/admin/students/save','StudentController@save')->name('admin.students.save');

//edit students
    Route::get('/admin/students/edit/{student}','StudentController@edit')->name('admin.students.edit');

//delete students
    Route::post('/admin/students/delete','StudentController@delete')->name('admin.students.delete');

//view students
    Route::get('/admin/students/show/{student}','StudentController@show')->name('admin.students.show');

    /****************************************************************************************************/
//teacher management
    Route::get('/admin/teachers','TeacherController@index')->name('admin.teachers.index');

//create teacher
    Route::get('/admin/teachers/create','TeacherController@create')->name('admin.teachers.create');

//save teacher
    Route::post('/admin/teachers/save','TeacherController@save')->name('admin.teachers.save');

//edit teacher
    Route::get('/admin/teachers/edit/{teacher}','TeacherController@edit')->name('admin.teachers.edit');

//delete teacher
    Route::post('/admin/teachers/delete','TeacherController@delete')->name('admin.teachers.delete');

//view teacher
    Route::get('/admin/teachers/show/{teacher}','TeacherController@show')->name('admin.teachers.show');

    /****************************************************************************************************/

//courses management
    Route::get('admin/courses','CourseController@index')->name('admin.courses.index');

//create courses
    Route::get('/admin/courses/create','CourseController@create')->name('admin.courses.create');

//save courses
    Route::post('/admin/courses/save','CourseController@save')->name('admin.courses.save');

//edit courses
    Route::get('/admin/courses/edit/{course}','CourseController@edit')->name('admin.courses.edit');

//delete courses
    Route::post('/admin/courses/delete','CourseController@delete')->name('admin.courses.delete');

//view courses
    Route::get('/admin/courses/show/{course}','CourseController@show')->name('admin.courses.show');

    /****************************************************************************************************/

//user management
    Route::get('/admin/users','UserController@index')->name('admin.users.index');

//create user
    Route::get('/admin/users/create','UserController@create')->name('admin.users.create');

//save user
    Route::post('/admin/users/save','UserController@save')->name('admin.users.save');



});
