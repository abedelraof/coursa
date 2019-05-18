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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/students', 'StudentsController@index')->name('admin.students.index');
Route::get('/admin/students/create', 'StudentsController@create')->name('admin.students.create');
Route::get('/admin/students/edit/{student}', 'StudentsController@edit')->name('admin.students.edit');

Route::post('/admin/students/save', 'StudentsController@save')->name('admin.students.save');
Route::post('/admin/students/delete', 'StudentsController@delete')->name('admin.students.delete');
