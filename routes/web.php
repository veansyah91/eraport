<?php

Auth::routes();

Route::get('/', 'User\GuestController@index')->name('guest-index');
Route::get('/student-registry', 'User\GuestController@studentRegitry')->name('guest-registry');
Route::post('/student-registry', 'User\GuestController@storeStudentRegitry')->name('student-registry');
Route::get('/status-registry-student/nik={nik}', 'User\GuestController@statusStudentRegistry');
Route::post('/status-registry-student', 'User\GuestController@cekStatusStudentRegistry')->name('status-registry');

Route::group(['middleware' => ['auth','role:ADMIN|SUPER ADMIN']], function () {

    Route::get('/sekolah', 'Admin\SchoolController@index');
    Route::get('/tambah-sekolah', 'Admin\SchoolController@create');
    Route::post('/tambah-sekolah', 'Admin\SchoolController@store');
    Route::get('/edit-sekolah', 'Admin\SchoolController@edit');
    Route::patch('/edit-sekolah/{school}', 'Admin\SchoolController@update');

    // Pendaftaran Siswa Baru
    Route::get('/registry-schedule','Admin\RegistryStudentController@schedule');
    Route::patch('/registry-schedule','Admin\RegistryStudentController@storeSchedule');
    Route::get('/registered-students', 'Admin\RegistryStudentController@studentsRegistered');
    Route::post('/accept-student', 'Admin\RegistryStudentController@acceptStudent');
    Route::post('/cancel-accept-student', 'Admin\RegistryStudentController@cancelAcceptStudent');
    Route::post('/reject-student', 'Admin\RegistryStudentController@rejectStudent');

    Route::get('/accepted-student','Admin\RegistryStudentController@acceptedStudent');
    Route::get('/rejected-student','Admin\RegistryStudentController@rejectedStudent');


    //tahun ajaran
    Route::get('/tambah-tahun-ajar', 'Admin\YearController@ganjil');
    Route::get('/tambah-tahun-ajar-genap', 'Admin\YearController@genap');

    //jabatan
    Route::get('/positions','Admin\PositionController@index');
    Route::get('/add-default','Admin\PositionController@default');
    Route::post('/add-position','Admin\PositionController@store');
    Route::post('/add-staff-position','Admin\PositionController@staffstore');
    Route::get('/position/{position}/delete','Admin\PositionController@destroy');
    Route::get('/position/{staffperiod}/deletestaff','Admin\PositionController@destroystaff');

    //staff
    Route::get('/staff', 'Admin\StaffController@index');
    Route::get('/add-staff', 'Admin\StaffController@create');
    Route::post('/add-staff', 'Admin\StaffController@store');
    Route::get('/staff/{staff}/delete','Admin\StaffController@destroy');
    Route::get('/staff/{staff}', 'Admin\StaffController@edit');
    Route::patch('/staff/{staff}/edit','Admin\StaffController@update');
    Route::get('getdatastaff',[
        'uses' => 'Admin\StaffController@getdatastaff',
        'as' => 'ajax.get.data.staff'
    ]);
    Route::get('getselectdatastaff',[
        'uses' => 'Admin\StaffController@getselectdatastaff',
        'as' => 'ajax.get.select.data.staff'
    ]);
    Route::get('/registry-staff', 'Admin\StaffController@registry')->name('registry.staff');
    Route::get('/registry-staff/{staff}', 'Admin\StaffController@registryAdd')->name('registry.staff.add');
    Route::post('/registry-staff/{staff}', 'Admin\StaffController@registryStore')->name('registry.staff.store');
    Route::get('/reset-staff-password/{user}', 'Admin\StaffController@registryReset')->name('registry.staff.reset');
    Route::get('/edit-staff-email/{user}', 'Admin\StaffController@emailEdit')->name('email.staff.edit');
    Route::patch('/update-staff-email/{user}', 'Admin\StaffController@emailUpdate')->name('email.staff.update');
    Route::get('getuserdatastaff',[
        'uses' => 'Admin\StaffController@getuserdatastaff',
        'as' => 'ajax.get.user.data.staff'
    ]);

    //student
    Route::get('/students', 'Admin\StudentController@index');
    Route::get('/add-student', 'Admin\StudentController@create');
    Route::get('/student/{student}','Admin\StudentController@show');
    Route::post('/add-student', 'Admin\StudentController@store');
    Route::get('/student/{student}/delete','Admin\StudentController@destroy');
    Route::get('/student/{student}/edit','Admin\StudentController@edit');
    Route::get('/student/set-level-student/{student}','Admin\StudentController@createLevelStudent');
    Route::post('/student/set-level-student','Admin\StudentController@storeLevelStudent');
    Route::patch('/student/{student}/edit','Admin\StudentController@update');
    Route::patch('/student/{student}/editprofilsiswa','Admin\StudentController@updateprofil');
    Route::patch('/student/{student}/editbiodatasiswa','Admin\StudentController@updatebiodata');
    Route::patch('/student/{student}/editbiodataorangtua','Admin\StudentController@updatebiodataorangtua');
    Route::patch('/student/{student}/editalamat','Admin\StudentController@updatealamat');
    Route::patch('/student/{student}/{levelstudent}/editriwayatsekolah','Admin\StudentController@updateriwayatsekolah');
    Route::get('/registry-student', 'Admin\StudentController@registry')->name('registry.student');
    Route::get('/registry-student/{student}', 'Admin\StudentController@registryAdd')->name('registry.student.add');
    Route::post('/registry-student/{student}', 'Admin\StudentController@registryStore')->name('registry.student.store');
    Route::get('/reset-student-password/{user}', 'Admin\StudentController@registryReset')->name('registry.student.reset');
    Route::get('/edit-student-email/{user}', 'Admin\StudentController@emailEdit')->name('registry.student.edit');
    Route::patch('/update-student-email/{user}', 'Admin\StudentController@emailUpdate')->name('email.student.update');
    Route::get('getdatastudents',[
        'uses' => 'Admin\StudentController@getdatastudents',
        'as' => 'ajax.get.data.students'
    ]);
    Route::get('getuserdatastudent',[
        'uses' => 'Admin\StudentController@getuserdatastudent',
        'as' => 'ajax.get.user.data.student'
    ]);

    Route::get('/student/print/subkelas={sublevel}','Admin\StudentController@printDataStudent');

    // Social
    Route::get('/socials','Admin\SocialController@index');
    Route::post('/add-socials','Admin\SocialController@store');
    Route::get('/social/{social}/delete','Admin\SocialController@destroy');
    Route::patch('/social/{social}/edit','Admin\SocialController@update');

    // Spiritual
    Route::get('/spirituals','Admin\SpiritualController@index');
    Route::post('/add-spirituals','Admin\SpiritualController@store');
    Route::get('/spiritual/{spiritual}/delete','Admin\SpiritualController@destroy');
    Route::patch('/spiritual/{spiritual}/edit','Admin\SpiritualController@update');


    //Subject
    Route::get('/subjects','Admin\SubjectController@index');
    Route::post('/add-subjects','Admin\SubjectController@store');
    Route::get('/subject/{subject}/delete','Admin\SubjectController@destroy');
    Route::patch('/subject/{subject}/edit','Admin\SubjectController@update');

    //extracurricular
    Route::get('/extracurriculars','Admin\ExtracurricularController@index');
    Route::post('/add-extracurricular','Admin\ExtracurricularController@store');
    Route::get('/extracurricular/{extracurricular}/delete','Admin\ExtracurricularController@destroy');
    Route::patch('/extracurricular/{extracurricular}/edit','Admin\ExtracurricularController@update');

    // Konversi Nilai
    Route::get('/converts','Admin\ConvertController@index');
    Route::post('/add-converts','Admin\ConvertController@store');
    Route::get('/add-score','Admin\ConvertController@storescore')->name('addscore');
    Route::patch('/edit-score','Admin\ConvertController@updatescore')->name('editscore');
    Route::patch('/edit-converts','Admin\ConvertController@update');

    //class
    Route::get('/classes','Admin\LevelController@index');
    Route::get('/classes-create','Admin\LevelController@create');
    Route::get('/classes/{level}/{sublevel}/delete','Admin\LevelController@deleteSublevel');
    Route::get('/classes/{level}','Admin\LevelController@indexSubLevel');
    Route::patch('/classes/{level}/edit','Admin\LevelController@updateSublevel');
    Route::patch('/classes/{level}/{sublevel}/edit','Admin\LevelController@updateAliasSublevel');
    Route::post('/classes/{level}/{semester}/add-subject','Admin\LevelController@storeLevelSubject');
    Route::get('/classes/{level}/subject/{levelsubject}/delete','Admin\LevelController@deleteLevelSubject');
    Route::post('/classes/{sublevel}/{year}/add-walikelas','Admin\LevelController@addWalikelas');
    Route::post('/classes/{level}/add-subkelas-siswa','Admin\LevelController@addStudentSubLevel');
    Route::post('/classes/{level}/{sublevelstudent}/edit-subkelas-siswa','Admin\LevelController@editStudentSubLevel');
    Route::patch('/classes/{sublevel}/{homeroomteacher}/edit-walikelas','Admin\LevelController@editWalikelas');
    Route::post('/classes/{sublevel}/{levelsubject}/tambah-guru-mata-pelajaran','Admin\LevelController@addGuruMataPelajaran');
    Route::patch('/classes/{sublevel}/{levelsubjectteacher}/edit-guru-mata-pelajaran','Admin\LevelController@editGuruMataPelajaran');
    Route::post('/classes/{level}/{semester}/add-spiritual','Admin\LevelController@addSpiritualPeriod');
    Route::post('/classes/{level}/{semester}/add-social','Admin\LevelController@addSocialPeriod');
    Route::get('/classes/{level}/spiritual/{spiritualperiod}/delete','Admin\LevelController@deleteSpiritualPeriod');
    Route::get('/classes/{level}/social/{socialperiod}/delete','Admin\LevelController@deleteSocialPeriod');

    // Level Subject
    Route::get('/levelsubject/{levelsubject}','Admin\LevelSubjectController@index');
    Route::patch('/levelsubject/{levelsubject}/edit','Admin\LevelSubjectController@update');

    //Knowledge Base Competence
    Route::post('/levelsubject/{levelsubject}/add-knowledge-competence','Admin\LevelSubjectController@storeKnowledgeCompetence');
    Route::get('/levelsubject/{knowledgebasecompetence}/delete-knowledge-competence','Admin\LevelSubjectController@deleteKnowledgeCompetence');
    Route::patch('/levelsubject/{knowledgebasecompetence}/edit-knowledge-competence','Admin\LevelSubjectController@updateKnowledgeCompetence');

    //Practice Base Competence
    Route::post('/levelsubject/{levelsubject}/add-practice-competence','Admin\LevelSubjectController@storePracticeCompetence');
    Route::get('/levelsubject/{practicebasecompetence}/delete-practice-competence','Admin\LevelSubjectController@deletePracticeCompetence');
    Route::patch('/levelsubject/{practicebasecompetence}/edit-practice-competence','Admin\LevelSubjectController@updatePracticeCompetence');

    // Score
    Route::get('/score/{level}','Admin\ScoreController@index');
    Route::patch('/score/{socialperiod}/{student}/create-social-score','Admin\ScoreController@createSocialScore');
    Route::patch('/score/{spiritualperiod}/{student}/create-spiritual-score','Admin\ScoreController@createSpiritualScore');
    Route::patch('/score/{sublevel}/{knowledge}/{scoreratio}/{student}/create-knowledge-score','Admin\ScoreController@createKnowledgeScore');
    Route::patch('/score/{sublevel}/{practice}/{student}/create-practice-score','Admin\ScoreController@createPracticeScore');
    Route::post('/score/{level}/{semester}/{student}/create-extra','Admin\ScoreController@createExtra');
    Route::patch('/score/{level}/{semester}/{student}/{extra}/edit-extra','Admin\ScoreController@editExtra');

    Route::patch('/score/{level}/{semester}/{student}/add-advice','Admin\ScoreController@addAdvice');

    Route::patch('/score/{level}/{semester}/{student}/add-absent','Admin\ScoreController@addAbsent');
    Route::patch('/score/{level}/{semester}/{student}/add-status','Admin\ScoreController@addStatus');
    Route::get('/score/{levelsubject}/{sublevel}/add-score-subject','Admin\ScoreController@addSubjectScore');
    Route::get('/score/{levelsubject}/{sublevel}/add-score-practice-subject','Admin\ScoreController@addPracticeSubjectScore');

    Route::get('/report/{level}','Admin\RaportController@index');
    Route::get('/report/{sublevel}/{student}/cover','Admin\RaportController@printCover');
    Route::get('/report/{sublevel}/{student}/rapor-nilai','Admin\RaportController@printScore');
    Route::get('/report/{sublevel}/{student}/rapor-deskripsi','Admin\RaportController@printDescription');

    Route::get('/roles','Admin\RoleController@index');
    Route::post('/store-position','Admin\RoleController@store');
    Route::get('/role/{role}/delete','Admin\RoleController@destroy');
    Route::get('/special-roles','Admin\RoleController@specialRoles');
    Route::post('/store-model-role','Admin\RoleController@storeModelRole');

    Route::get('/psb','Admin\EntryPaymentController@index');
    Route::patch('/psb/{student}','Admin\EntryPaymentController@store');

    Route::get('/credit-payment/{student}','Admin\CreditPaymentController@index');
    Route::post('/credit-payment/{student}','Admin\CreditPaymentController@store');
    Route::delete('/credit-payment/{creditPayment}','Admin\CreditPaymentController@destroy');

    Route::get('/spp','Admin\MonthlyPaymentController@index');
    Route::patch('/spp/{student}','Admin\MonthlyPaymentController@store');

    Route::get('/credit-monthly-payment/{year}/{student}','Admin\CreditMonthlyPaymentController@index');
    Route::post('/credit-monthly-payment/{year}/{student}','Admin\CreditMonthlyPaymentController@store');
    Route::delete('/credit-monthly-payment/{creditMonthlyPayment}','Admin\CreditMonthlyPaymentController@destroy');

    Route::get('/buku','Admin\BookPaymentController@index');
    Route::patch('/buku/{student}/{year}','Admin\BookPaymentController@store');

    Route::get('/buku/detail/{bookpayment}','Admin\CreditBookPaymentController@index');
    Route::post('/buku/detail/{bookpayment}','Admin\CreditBookPaymentController@store');
    Route::delete('/buku/detail/{creditbookpayment}','Admin\CreditBookPaymentController@destroy');

    // Jadwal Ujian
    Route::get('/test-schedule','Admin\TestScheduleController@index');
    Route::get('/test-schedule/{level}','Admin\TestScheduleController@testSchedulePerLevel');
    Route::patch('/test-schedule/{semester}','Admin\TestScheduleController@setSchedule');
    Route::patch('/test-schedule/set-schedule/{levelsubject}','Admin\TestScheduleController@setTestSchedulePerLevel');
    Route::patch('/test-schedule/{schedule}/set-student-schedule/{levelstudent}','Admin\TestScheduleController@setTestSchedulePerStudent');
    Route::post('/test-schedule/set-schedule-tema/semesterId={semester}/levelId={level}','Admin\TestScheduleController@setTestSchedulePerTema');
    Route::patch('/test-schedule/set-schedule-tema/update/semesterId={semester}/levelId={level}','Admin\TestScheduleController@updateTestSchedulePerTema');
    Route::delete('/test-schedule/{testschedule}','Admin\TestScheduleController@deleteTestSchedule');
    Route::delete('/test-schedule/theme/{testschedule}','Admin\TestScheduleController@deleteThemeTestSchedule');

    Route::get('/inventories','Admin\InventoryController@index');
    Route::get('/create-inventory-item','Admin\InventoryController@createInventoryItem');
    Route::patch('/store-inventory/id={item}','Admin\InventoryController@storeInventory');
    Route::post('/store-inventory-item','Admin\InventoryController@storeInventoryItem');
    Route::delete('/delete-inventory/id={id}','Admin\InventoryController@destroyInventoryItem');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile','HomeController@profile');
    Route::get('/change-password','Auth\ChangePasswordController@index');
    Route::patch('/change-password','Auth\ChangePasswordController@update');

    Route::get('/psb-siswa','Student\StudentController@psb');
    Route::get('/{year}/spp-siswa','Student\StudentController@spp');
    Route::get('/{year}/pembayaran-buku-siswa','Student\StudentController@buku');

    Route::get('/ujian/testScheduleId={testschedule}','Student\StudentController@test');

});

Route::group(['middleware' => ['auth','role:GURU']], function () {

    Route::get('/subLevelId={sublevel}/studentId={student}/penilaian/spiritual','Teacher\TeacherController@showSpiritualStudent');
    Route::patch('/subLevelId={sublevel}/studentId={student}/penilaian/spiritual','Teacher\TeacherController@updateSpiritualStudent');

    Route::get('/subLevelId={sublevel}/studentId={student}/penilaian/sosial','Teacher\TeacherController@showSocialStudent');
    Route::patch('/subLevelId={sublevel}/studentId={student}/penilaian/sosial','Teacher\TeacherController@updateSocialStudent');

    Route::get('/subLevelId={sublevel}/penilaian/spiritual','Teacher\TeacherController@spiritual');
    Route::get('/subLevelId={sublevel}/penilaian/sosial','Teacher\TeacherController@social');
    Route::get('/subLevelId={sublevel}/ekstrakurikuler','Teacher\TeacherController@ekstrakurikuler');
    Route::get('/subLevelId={sublevel}/saran','Teacher\TeacherController@saran');
    Route::get('/subLevelId={sublevel}/ketidakhadiran','Teacher\TeacherController@ketidakhadiran');

    Route::get('/penilaian/{sublevel}/{levelsubject}','Teacher\TeacherController@index');
    Route::get('/penilaian/{sublevel}/{levelsubject}/nilai-pengetahuan','Teacher\TeacherController@knowledgeScore');
    Route::get('/penilaian/{sublevel}/{levelsubject}/{student}/nilai-pengetahuan','Teacher\TeacherController@createknowledgeScoreStudent');
    Route::patch('/penilaian/{sublevel}/{levelsubject}/{student}/nilai-pengetahuan','Teacher\TeacherController@storeknowledgeScoreStudent');

    Route::patch('/subLevelId={sublevel}/ekstrakurikuler','Teacher\TeacherController@storeExtraStudent');
    Route::patch('/subLevelId={sublevel}/saran','Teacher\TeacherController@storeSaran');
    Route::patch('/subLevelId={sublevel}/ketidakhadiran','Teacher\TeacherController@storeKetidakhadiran');

    Route::get('/penilaian/{sublevel}/{levelsubject}/nilai-keterampilan','Teacher\TeacherController@practiceScore');
    Route::get('/penilaian/{sublevel}/{levelsubject}/{student}/nilai-keterampilan','Teacher\TeacherController@createPracticeScoreStudent');
    Route::patch('/penilaian/{sublevel}/{levelsubject}/{student}/nilai-keterampilan','Teacher\TeacherController@storePracticeScoreStudent');

    Route::get('/ujian/levelsubjectid={levelsubject}','Teacher\TeacherController@urlTest');
    Route::get('/ujian/levelsubjectid={levelsubject}/periodid={scoreratio}','Teacher\TeacherController@showTest');
    Route::get('/ujian/levelsubjectid={levelsubject}/periodid={scoreratio}/create','Teacher\TeacherController@createTest');
    Route::post('/ujian/levelsubjectid={levelsubject}/periodid={scoreratio}','Teacher\TeacherController@storeTest');
    Route::delete('/ujian/questionId={question}/delete-question','Teacher\TeacherController@deleteQuestion');


    Route::patch('/ujian/questionId={question}/update-number','Teacher\TeacherController@updateNumber');
    Route::patch('/ujian/questionId={question}/update-kd','Teacher\TeacherController@updatekd');
    Route::patch('/ujian/questionId={question}/delete-image','Teacher\TeacherController@deleteImage');
    Route::patch('/ujian/questionId={question}/update-image','Teacher\TeacherController@updateImage');
    Route::patch('/ujian/questionId={question}/update-question','Teacher\TeacherController@updateQuestion');
    Route::patch('/ujian/questionId={question}/update-answer-type','Teacher\TeacherController@updateAnswerType');
    Route::patch('/ujian/questionId={question}/update-answer','Teacher\TeacherController@updateAnswer');
    Route::patch('/ujian/questionId={question}/update-answers','Teacher\TeacherController@updateAnswers');
    Route::patch('/ujian/questionId={question}/update-answer-option','Teacher\TeacherController@updateAnswerOption');
    Route::patch('/ujian/questionId={question}/update-explanation','Teacher\TeacherController@updateExplanation');

    Route::patch('/ujian/levelsubjectid={levelsubject}','Teacher\TeacherController@setUrlTest');

    Route::get('/ujian/levelsubjectid={levelsubject}/periodid={scoreratio}/print','Teacher\TeacherController@printTest');
    Route::get('/ujian/levelsubjectid={levelsubject}/periodid={scoreratio}/file','Teacher\TeacherController@printFile');

    Route::get('/ujian/tema/levelid={level}','Teacher\TeacherController@urlTestTheme');
    Route::post('/ujian/tema/levelId={level}/semesterId={semester}/create','Teacher\TeacherController@createTheme');
    Route::patch('/ujian/tema/levelId={level}/semesterId={semester}/update','Teacher\TeacherController@updateTheme');
    Route::delete('/ujian/tema/levelId={level}/semesterId={semester}/delete','Teacher\TeacherController@deleteTheme');

    Route::get('/ujian/tema/levelid={level}/semesterId={semester}/periodId={scoreratio}/themeId={themesubject}/showTest','Teacher\TeacherController@showTestTheme');
    Route::get('/ujian/tema/levelid={level}/semesterId={semester}/periodId={scoreratio}/themeId={themesubject}/createTest','Teacher\TeacherController@createTestTheme');
    Route::post('/ujian/tema/levelid={level}/semesterId={semester}/periodId={scoreratio}/themeId={themesubject}/storeTest','Teacher\TeacherController@storeTestTheme');

    Route::get('/ujian/tema/periodId={scoreratio}/themeId={themesubject}/print','Teacher\TeacherController@printThemeTest');
    Route::get('/ujian/tema/periodId={scoreratio}/themeId={themesubject}/file','Teacher\TeacherController@printThemeFile');


    Route::patch('/url-ujian/tema/levelid={level}','Teacher\TeacherController@setUrlTestTema');
    Route::patch('/url-ujian/tema/update/levelid={level}','Teacher\TeacherController@updateUrlTestTema');

    Route::post('/levelsubject/{sublevel}/{levelsubject}/add-knowledge-competence','Teacher\TeacherController@storeKnowledgeCompetence');
    Route::delete('/levelsubject/{sublevel}/{knowledgebasecompetence}/delete-knowledge-competence','Teacher\TeacherController@deleteKnowledgeCompetence');
    Route::patch('/levelsubject/{sublevel}/{knowledgebasecompetence}/edit-knowledge-competence','Teacher\TeacherController@updateKnowledgeCompetence');

    //Practice Base Competence
    Route::post('/levelsubject/{sublevel}/{levelsubject}/add-practice-competence','Teacher\TeacherController@storePracticeCompetence');
    Route::delete('/levelsubject/{sublevel}/{practicebasecompetence}/delete-practice-competence','Teacher\TeacherController@deletePracticeCompetence');
    Route::patch('/levelsubject/{sublevel}/{practicebasecompetence}/edit-practice-competence','Teacher\TeacherController@updatePracticeCompetence');

    Route::patch('/penilaian/{sublevel}/{practice}/{student}/create-practice-score','Teacher\TeacherController@createPracticeScore');
    Route::patch('/penilaian/{sublevel}/{knowledge}/{scoreratio}/{student}/create-knowledge-score','Teacher\TeacherController@createKnowledgeScore');

    Route::get('/cetak-rapor/tengah-semester/{sublevel}/{semester}','Teacher\TeacherController@printMidSemesterReport');
    Route::get('/cetak-rapor/tengah-semester/{sublevel}/{semester}/{student}','Teacher\TeacherController@printMidSemesterReportStudent');

    Route::get('/cetak-rapor/akhir-semester/{sublevel}','Teacher\TeacherController@printLastSemesterReport');
    Route::get('/cetak-rapor/akhir-semester/sublevelId={sublevel}/studentId={student}/cover','Teacher\TeacherController@printLastSemesterReportCover');
    Route::get('/cetak-rapor/akhir-semester/sublevelId={sublevel}/studentId={student}/score','Teacher\TeacherController@printLastSemesterReportScore');
    Route::get('/cetak-rapor/akhir-semester/sublevelId={sublevel}/studentId={student}/description','Teacher\TeacherController@printLastSemesterReportDescription');
    Route::get('/cetak-rapor/akhir-semester/sublevelId={sublevel}/rekap-nilai','Teacher\TeacherController@exportScoreToExcel');
});
