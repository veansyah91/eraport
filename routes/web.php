<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'SchoolController@index');
Route::get('/tambah-sekolah', 'SchoolController@create');
Route::post('/tambah-sekolah', 'SchoolController@store');
Route::get('/edit-sekolah', 'SchoolController@edit');
Route::patch('/edit-sekolah/{school}', 'SchoolController@update');

//tahun ajaran
Route::get('/tambah-tahun-ajar', 'YearController@ganjil');
Route::get('/tambah-tahun-ajar-genap', 'YearController@genap');

//jabatan
Route::get('/positions','PositionController@index');
Route::get('/add-default','PositionController@default');
Route::post('/add-position','PositionController@store');
Route::post('/add-staff-position','PositionController@staffstore');
Route::get('/position/{position}/delete','PositionController@destroy');
Route::get('/position/{staffperiod}/deletestaff','PositionController@destroystaff');

//staff
Route::get('/staff', 'StaffController@index');
Route::get('/add-staff', 'StaffController@create');
Route::post('/add-staff', 'StaffController@store');
Route::get('/staff/{staff}/delete','StaffController@destroy');
Route::get('/staff/{staff}', 'StaffController@edit');
Route::patch('/staff/{staff}/edit','StaffController@update');
Route::get('getdatastaff',[
    'uses' => 'StaffController@getdatastaff',
    'as' => 'ajax.get.data.staff'
]);
Route::get('getselectdatastaff',[
    'uses' => 'StaffController@getselectdatastaff',
    'as' => 'ajax.get.select.data.staff'
]);

//student
Route::get('/students', 'StudentController@index');
Route::get('/add-student', 'StudentController@create');
Route::get('/student/{student}','StudentController@show');
Route::post('/add-student', 'StudentController@store');
Route::get('/student/{student}/delete','StudentController@destroy');
Route::patch('/student/{student}/edit','StudentController@update');
Route::patch('/student/{student}/editprofilsiswa','StudentController@updateprofil');
Route::patch('/student/{student}/editbiodatasiswa','StudentController@updatebiodata');
Route::patch('/student/{student}/editbiodataorangtua','StudentController@updatebiodataorangtua');
Route::patch('/student/{student}/editalamat','StudentController@updatealamat');
Route::patch('/student/{student}/{levelstudent}/editriwayatsekolah','StudentController@updateriwayatsekolah');
Route::get('getdatastudents',[
    'uses' => 'StudentController@getdatastudents',
    'as' => 'ajax.get.data.students'
]);

// Social
Route::get('/socials','SocialController@index');
Route::post('/add-socials','SocialController@store');
Route::get('/social/{social}/delete','SocialController@destroy');
Route::patch('/social/{social}/edit','SocialController@update');

// Spiritual
Route::get('/spirituals','SpiritualController@index');
Route::post('/add-spirituals','SpiritualController@store');
Route::get('/spiritual/{spiritual}/delete','SpiritualController@destroy');
Route::patch('/spiritual/{spiritual}/edit','SpiritualController@update');


//Subject
Route::get('/subjects','SubjectController@index');
Route::post('/add-subjects','SubjectController@store');
Route::get('/subject/{subject}/delete','SubjectController@destroy');
Route::patch('/subject/{subject}/edit','SubjectController@update');

//extracurricular
Route::get('/extracurriculars','ExtracurricularController@index');
Route::post('/add-extracurricular','ExtracurricularController@store');
Route::get('/extracurricular/{extracurricular}/delete','ExtracurricularController@destroy');
Route::patch('/extracurricular/{extracurricular}/edit','ExtracurricularController@update');

// Konversi Nilai
Route::get('/converts','ConvertController@index');
Route::post('/add-converts','ConvertController@store');
Route::get('/add-score','ConvertController@storescore')->name('addscore');
Route::patch('/edit-score','ConvertController@updatescore')->name('editscore');
Route::patch('/edit-converts','ConvertController@update');


//class
Route::get('/classes','LevelController@index');
Route::get('/classes-create','LevelController@create');
Route::get('/classes/{level}/{sublevel}/delete','LevelController@deleteSublevel');
Route::get('/classes/{level}','LevelController@indexSubLevel');
Route::patch('/classes/{level}/edit','LevelController@updateSublevel');
Route::patch('/classes/{level}/{sublevel}/edit','LevelController@updateAliasSublevel');
Route::post('/classes/{level}/{semester}/add-subject','LevelController@storeLevelSubject');
Route::get('/classes/{level}/subject/{levelsubject}/delete','LevelController@deleteLevelSubject');
Route::post('/classes/{sublevel}/{year}/add-walikelas','LevelController@addWalikelas');
Route::post('/classes/{level}/add-subkelas-siswa','LevelController@addStudentSubLevel');
Route::post('/classes/{level}/{sublevelstudent}/edit-subkelas-siswa','LevelController@editStudentSubLevel');
Route::patch('/classes/{sublevel}/{homeroomteacher}/edit-walikelas','LevelController@editWalikelas');
Route::post('/classes/{sublevel}/{levelsubject}/tambah-guru-mata-pelajaran','LevelController@addGuruMataPelajaran');
Route::patch('/classes/{sublevel}/{levelsubjectteacher}/edit-guru-mata-pelajaran','LevelController@editGuruMataPelajaran');
Route::post('/classes/{level}/{semester}/add-spiritual','LevelController@addSpiritualPeriod');
Route::post('/classes/{level}/{semester}/add-social','LevelController@addSocialPeriod');
Route::get('/classes/{level}/spiritual/{spiritualperiod}/delete','LevelController@deleteSpiritualPeriod');
Route::get('/classes/{level}/social/{socialperiod}/delete','LevelController@deleteSocialPeriod');

// Level Subject
Route::get('/levelsubject/{levelsubject}','LevelSubjectController@index');
Route::patch('/levelsubject/{levelsubject}/edit','LevelSubjectController@update');

//Knowledge Base Competence
Route::post('/levelsubject/{levelsubject}/add-knowledge-competence','LevelSubjectController@storeKnowledgeCompetence');
Route::get('/levelsubject/{knowledgebasecompetence}/delete-knowledge-competence','LevelSubjectController@deleteKnowledgeCompetence');
Route::patch('/levelsubject/{knowledgebasecompetence}/edit-knowledge-competence','LevelSubjectController@updateKnowledgeCompetence');

//Practice Base Competence
Route::post('/levelsubject/{levelsubject}/add-practice-competence','LevelSubjectController@storePracticeCompetence');
Route::get('/levelsubject/{practicebasecompetence}/delete-practice-competence','LevelSubjectController@deletePracticeCompetence');
Route::patch('/levelsubject/{practicebasecompetence}/edit-practice-competence','LevelSubjectController@updatePracticeCompetence');



