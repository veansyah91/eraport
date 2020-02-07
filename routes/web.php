<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'SchoolController@index');
Route::get('/tambah-sekolah', 'SchoolController@create');
Route::post('/tambah-sekolah', 'SchoolController@store');
Route::get('/edit-sekolah', 'SchoolController@edit');
Route::patch('/edit-sekolah/{school}', 'SchoolController@update');

//tahun ajaran
Route::post('/tambah-tahun-ajar', 'YearController@store');

//staff
Route::get('/staffs', 'StaffController@index');
Route::get('/add-staff', 'StaffController@create');
Route::post('/add-staff', 'StaffController@store');
Route::get('/staff/{staff}/delete','StaffController@destroy');
Route::get('/staff/{staff}', 'StaffController@edit');
Route::patch('/staff/{staff}/edit','StaffController@update');

//student
Route::get('/students', 'StudentController@index');
Route::get('/add-student', 'StudentController@create');
Route::post('/add-student', 'StudentController@store');
Route::get('/student/{student}/delete','StudentController@destroy');
Route::get('/student/{student}', 'StudentController@edit');
Route::patch('/student/{student}/edit','StudentController@update');

//Subject
Route::get('/subjects','SubjectController@index');
Route::post('/add-subjects','SubjectController@store');
Route::get('/subject/{subject}/delete','SubjectController@destroy');
Route::patch('/subject/{subject}/edit','SubjectController@update');

//class
Route::get('/classes','LevelController@index');
Route::get('/classes-create','LevelController@create');
Route::get('/classes/{level}/{sublevel}/delete','LevelController@deleteSublevel');
Route::get('/classes/{level}','LevelController@indexSubLevel');
Route::patch('/classes/{level}/edit','LevelController@updateSublevel');
Route::patch('/classes/{level}/{sublevel}/edit','LevelController@updateAliasSublevel');

