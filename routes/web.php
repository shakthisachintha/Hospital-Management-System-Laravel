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

Route::get('/', 'HomeController@index');

// Auth Routes
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => '', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes...
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/reset', ['as' => 'password.update', 'uses' => 'Auth\ResetPasswordController@reset']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
// End Auth Routes

//User Profile Language and Dashboard
Route::get('/profile', ['as' => 'profile', 'uses' => 'HomeController@profile'])->middleware('auth', 'lang');
Route::get('/dash', ['as' => 'dash', 'uses' => 'HomeController@index'])->middleware('auth');
Route::get('/lang/{lan}', ['as' => 'lang', 'uses' => 'HomeController@setLocale'])->middleware('auth');
Route::post('/changepassword', ['as' => 'change_password', 'uses' => 'UserController@changeUserPassword'])->middleware('auth');
Route::post('/changepropic', ['as' => 'change_propic', 'uses' => 'UserController@changeUserPropic'])->middleware('auth');

//Make channels Routes
Route::post('/channel', ['as' => 'makechannel', 'uses' => 'PatientController@makeChannel'])->middleware('auth', 'staff', 'lang');
Route::post('/appoint', ['as' => 'makeappoint', 'uses' => 'PatientController@addChannel'])->middleware('auth', 'staff', 'lang');
Route::get('/createchannel', ['as' => 'create_channel_view', 'uses' => 'PatientController@create_channel_view'])->middleware('auth', 'staff', 'lang');

// Patients Registration (In Patient Out Patients)
Route::get('/patient', ['as' => 'patient', 'uses' => 'PatientController@index'])->middleware('auth', 'staff', 'lang');
Route::get('/patientregcard/{pid}', ['as' => 'pregcard', 'uses' => 'PatientController@regcard'])->middleware('auth', 'staff');
Route::post('/patientregister', ['as' => 'patient_register', 'uses' => 'PatientController@register_patient'])->middleware('auth', 'staff');
Route::get('/inpatientregister', ['as' => 'register_in_patient_view', 'uses' => 'PatientController@register_in_patient_view'])->middleware('auth', 'staff', 'lang');

// Issue Medicine(Pharmacist Routes)
Route::get('/issueMedicine', ['as' => 'issueMedicineView', 'uses' => 'MedicineController@issueMedicineView'])->middleware('auth', 'staff');
Route::post('/pharmacyValidate', ['as' => 'pharmacyValidate', 'uses' => 'MedicineController@pharmacyValidate'])->middleware('auth', 'staff');
Route::post('/issueMedicine', ['as' => 'issueMedicine', 'uses' => 'MedicineController@issueMedicine'])->middleware('auth', 'staff');

// Check Patient Routes
Route::get('/checkpatient', ['as' => 'check_patient_view', 'uses' => 'PatientController@check_patient_view'])->middleware('auth', 'doctor');
Route::post('/validateAppNum', ['as' => 'validateAppNum', 'uses' => 'PatientController@validateAppNum'])->middleware('auth', 'doctor');
Route::post('/checkpatient', ['as' => 'checkPatient', 'uses' => 'PatientController@checkPatient'])->middleware('auth', 'doctor');
Route::get('/medsuggest', ['as' => 'medicineSuggests', 'uses' => 'MedicineController@searchSuggestion'])->middleware('auth');
Route::post('/checksave', ['as' => 'checkSave', 'uses' => 'PatientController@checkPatientSave'])->middleware('auth', 'doctor');

// In patient Routes
Route::post('/markinpatient', ['as' => 'markInPatient', 'uses' => 'PatientController@markInPatient'])->middleware('auth', 'doctor');

// Search Patient Routes
Route::get('/searchpatient', ['as' => 'searchPatient', 'uses' => 'PatientController@searchPatient'])->middleware('auth', 'doctor', 'lang');
Route::get('/search', ['as' => 'searchData', 'uses' => 'PatientController@patientData'])->middleware('auth', 'doctor', 'lang');

//edit patitent routes
Route::post('/editpatient',['as'=> 'editpatient','uses' => 'PatientController@editPatientview'])->middleware('auth', 'doctor', 'lang');

//update patitent routes
Route::post('/updatepatientdetails',['as'=> 'updatepatientdetails','uses' => 'PatientController@updatePatient'])->middleware('auth', 'doctor', 'lang');


//Attendance Routes
Route::get('/myattend', ['as' => 'myattend', 'uses' => 'AttendController@myattend'])->middleware('auth', 'lang');
Route::get('/attendmore', ['as' => 'attendmore', 'uses' => 'AttendController@attendmore'])->middleware('auth', 'admin', 'lang');
Route::get('/attendance', ['as' => 'attendance', 'uses' => 'AttendController@markattendance'])->middleware('guest');

// Admin Routes For User Registration and Management
Route::get('/regfinger', ['as' => 'regfinger', 'uses' => 'UserController@showRegFingerprint'])->middleware('auth', 'admin', 'lang');
Route::post('regfinger', ['as' => 'user.regfinger', 'uses' => 'UserController@regFinger'])->middleware('auth', 'admin');
Route::get('/newuser', ['as' => 'newuser', 'uses' => 'UserController@regNew'])->middleware('auth', 'admin');
Route::get('/resetuser', ['as' => 'resetuser', 'uses' => 'UserController@resetUser'])->middleware('auth', 'admin');

// Admin Routes For Notices
Route::get('/createnoticeview', ['as' => 'createnoticeview', 'uses' => 'UserController@createnoticeview'])->middleware('auth','lang');
Route::post('/sendnotice', ['as' => 'sendnotice', 'uses' => 'UserController@send_notice'])->middleware('auth');
Route::post('/sendnotice', ['as' => 'sendnotice', 'uses' => 'UserController@send_notice'])->middleware('auth');
Route::get('/emails', ['as' => 'emails', 'uses' => 'UserController@email'])->middleware('auth');

// Report Generation Routes
Route::get('/reportgeneration', ['as' => 'reportgeneration', 'uses' => 'UserController@reportgen'])->middleware('auth');
Route::get('/clinicreports', ['as' => 'clinic_reports', 'uses' => 'ReportController@viewclinicreport'])->middleware('auth');
Route::get('/mobclinicreport', ['as' => 'mob_clinic_report', 'uses' => 'ReportController@view_mobile_clinic_report'])->middleware('auth');
Route::get('/monstatreport', ['as' => 'mon_stat_report', 'uses' => 'ReportController@view_monthly_static_report'])->middleware('auth');
Route::get('/outpreport', ['as' => 'out_p_report', 'uses' => 'ReportController@view_out_patient_report'])->middleware('auth');
Route::get('/attendancereport', ['as' => 'attendance_report', 'uses' => 'ReportController@view_attendance_report'])->middleware('auth');
Route::get('/wardreport', ['as' => 'ward_report', 'uses' => 'ReportController@view_ward_report'])->middleware('auth');
Route::post('/generatereports', ['as' => 'gen_att_reports', 'uses' => 'ReportController@gen_att_reports'])->middleware('auth');
Route::get('/allprintpreview', ['as' => 'all_print_preview', 'uses' => 'ReportController@all_print_preview'])->middleware('auth');

Route::get('/herbs',['as'=>'herbs', 'uses' => 'MedicineController@getherbs']);

