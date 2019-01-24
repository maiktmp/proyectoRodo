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

//==========================================
//               Login
//===========================================


Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('login/auth',
    'Auth\LoginController@authenticate')
    ->name('login_auth');

Route::get(
    'logout',
    'Auth\LoginController@logout'
)->name('logout');

//==========================================
//               Alumnos
//===========================================
Route::get(
    'student/revision',
    'StudentController@revision'
)->name('student_revision');

Route::post(
    'student/revision',
    'StudentController@revisionPost'
)->name('student_revision_post');

Route::view('student/process',
    'generales.process_index')
    ->name('process_student');


//==========================================
//               Admin
//===========================================

Route::get(
    'admin/main',
    'AdminController@index'
)->name('admin_index');

Route::get(
    'admin/process/{processId}/view',
    'AdminController@getProcess'
)->name('get_process');

Route::get(
    'admin/process/{processId}/update',
    'AdminController@updateProcess'
)->name('update_process');

Route::post(
    'admin/process/{processId}/update',
    'AdminController@updateProcessPost'
)->name('update_process_post');

Route::get(
    'teachers',
    'AdminController@getTeachers'
)->name('get_teachers');




