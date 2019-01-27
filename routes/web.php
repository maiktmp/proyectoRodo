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
    'generales.documents_index')
    ->name('process_student');


//==========================================
//               Admin
//===========================================

Route::get(
    'admin/main',
    'ProcessController@indexContents'
)->name('admin_index');

Route::get(
    'admin/process/{processId}/view',
    'ProcessController@view'
)->name('get_process');

Route::get(
    'admin/process/{processId}/update',
    'ProcessController@updateProcess'
)->name('update_process');

Route::post(
    'admin/process/{processId}/update',
    'ProcessController@updateProcessPost'
)->name('update_process_post');

Route::get(
    'admin/process/teachers',
    'ProcessController@getTeachers'
)->name('update_teachers');

