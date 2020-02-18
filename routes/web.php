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

//use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Route;

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
Route::post('/changecontactnumber', ['as' => 'changecontactnumber', 'uses' => 'UserController@changecontactnumber'])->middleware('auth');
Route::post('/changeemail', ['as' => 'changeemail', 'uses' => 'UserController@changeemail'])->middleware('auth');
Route::post('/edituserprofile', ['as' => 'editprofile', 'uses' => 'UserController@editprofile'])->middleware('auth');

//Make channels Routes
Route::post('/channel', ['as' => 'makechannel', 'uses' => 'PatientController@getPatientData'])->middleware('auth', 'staff', 'lang');
Route::post('/appoint', ['as' => 'makeappoint', 'uses' => 'PatientController@addChannel'])->middleware('auth', 'staff', 'lang');
Route::get('/createchannel', ['as' => 'create_channel_view', 'uses' => 'PatientController@create_channel_view'])->middleware('auth', 'staff', 'lang');

// Patients Registration (In Patient Out Patients)
Route::get('/patient', ['as' => 'patient', 'uses' => 'PatientController@index'])->middleware('auth', 'staff', 'lang');
Route::get('/patientregcard/{pid}', ['as' => 'pregcard', 'uses' => 'PatientController@regcard'])->middleware('auth', 'staff');
Route::post('/patientregister', ['as' => 'patient_register', 'uses' => 'PatientController@registerPatient'])->middleware('auth', 'staff');
Route::get('/inpatientregister', ['as' => 'register_in_patient_view', 'uses' => 'PatientController@register_in_patient_view'])->middleware('auth', 'staff', 'lang');
Route::post('/inpatientregister2', ['as' => 'regInPatient', 'uses' => 'PatientController@regInPatientValid'])->middleware('auth', 'staff', 'lang');
Route::post('/inpatientregister3', ['as' => 'save_inpatient', 'uses' => 'PatientController@store_inpatient'])->middleware('auth', 'staff', 'lang');
Route::get('/dischargeInpatient', ['as' => 'discharge_inpatient', 'uses' => 'PatientController@discharge_inpatient'])->middleware('auth', 'staff', 'lang');
Route::post('/dischargeInpatient2', ['as' => 'disInPatient', 'uses' => 'PatientController@disInPatientValid'])->middleware('auth', 'staff', 'lang');
Route::post('/dischargeInpatient3', ['as' => 'save_disinpatient', 'uses' => 'PatientController@store_disinpatient'])->middleware('auth', 'staff', 'lang');
Route::get('getDoctor', 'PatientController@getDoctor');

// Issue Medicine(Pharmacist Routes)
Route::get('/issueMedicine/', ['as' => 'issueMedicineView', 'uses' => 'MedicineController@issueMedicineView'])->middleware('auth', 'staff', 'lang');
Route::post('/issuemed-validate', ['as' => 'issueMedicine2', 'uses' => 'MedicineController@issueMedicineValid'])->middleware('auth', 'staff', 'lang');
Route::get('/issue/{presid}', ['as' => 'issue', 'uses' => 'MedicineController@issueMedicine'])->middleware('auth', 'staff', 'lang');
Route::post('/issuemark', ['as' => 'markIssued', 'uses' => 'MedicineController@markIssued'])->middleware('auth', 'staff', 'lang');
Route::get('/med-issue-save', ['as' => 'medIssueSave', 'uses' => 'MedicineController@medIssueSave'])->middleware('auth', 'staff', 'lang');

// Check Patient Routes
Route::get('/checkpatient', ['as' => 'check_patient_view', 'uses' => 'PatientController@checkPatientView'])->middleware('auth', 'doctor','lang');
Route::post('/validateAppNum', ['as' => 'validateAppNum', 'uses' => 'PatientController@validateAppNum'])->middleware('auth', 'doctor','lang');
Route::post('/checkpatient', ['as' => 'checkPatient', 'uses' => 'PatientController@checkPatient'])->middleware('auth', 'doctor','lang');
Route::post('/checksave', ['as' => 'checkSave', 'uses' => 'PatientController@checkPatientSave'])->middleware('auth', 'doctor','lang');
Route::post('/addclinic', ['as' => 'addToClinic', 'uses' => 'PatientController@addToClinic'])->middleware('auth', 'doctor','lang');

// In patient Routes
Route::post('/markinpatient', ['as' => 'markInPatient', 'uses' => 'PatientController@markInPatient'])->middleware('auth', 'doctor');

// Search & Patient Profile Routes
Route::get('/searchpatient', ['as' => 'searchPatient', 'uses' => 'PatientController@searchPatient'])->middleware('auth','staff','lang');
Route::get('/search', ['as' => 'searchData', 'uses' => 'PatientController@patientData'])->middleware('auth','staff','lang');
Route::get('/patient-profile', ['as' => 'patientProfileIntro', 'uses' => 'PatientController@patientProfileIntro'])->middleware('auth','staff', 'lang');
Route::get('/patient/{id}', ['as' => 'patientProfile', 'uses' => 'PatientController@patientProfile'])->middleware('auth', 'lang','staff');
Route::get('/patient-delete/{id}/{action}', ['as' => 'patientDelete', 'uses' => 'PatientController@patientDelete'])->middleware('auth', 'doctor', 'lang');
Route::get('/patient-history/{id}', ['as' => 'patientHistory', 'uses' => 'PatientController@patientHistory'])->middleware('auth','doctor', 'lang');

//edit patitent routes
Route::post('/editpatient', ['as' => 'editpatient', 'uses' => 'PatientController@editPatientview'])->middleware('auth', 'doctor', 'lang');

//update patitent routes
Route::post('/updatepatientdetails', ['as' => 'updatepatientdetails', 'uses' => 'PatientController@updatePatient'])->middleware('auth', 'doctor', 'lang');


//Attendance Routes
Route::get('/myattend', ['as' => 'myattend', 'uses' => 'AttendController@myattend'])->middleware('auth', 'lang');
Route::get('/attendmore', ['as' => 'attendmore', 'uses' => 'AttendController@attendmore'])->middleware('auth', 'admin', 'lang');
Route::get('/attendance', ['as' => 'attendance', 'uses' => 'AttendController@markattendance'])->middleware('guest');
Route::post('/getyearattendance', ['as' => 'getyearattendance', 'uses' => 'AttendController@myattend'])->middleware('auth', 'lang');
Route::post('/getattendancebyid', ['as' => 'getattendancebyid', 'uses' => 'AttendController@attendmore'])->middleware('auth', 'lang');

// Admin Routes For User Registration and Management
Route::get('/regfinger', ['as' => 'regfinger', 'uses' => 'UserController@showRegFingerprint'])->middleware('auth', 'admin', 'lang');
Route::post('regfinger', ['as' => 'user.regfinger', 'uses' => 'UserController@regFinger'])->middleware('auth', 'admin');
Route::get('/newuser', ['as' => 'newuser', 'uses' => 'UserController@regNew'])->middleware('auth', 'admin', 'lang');
Route::get('/resetuser', ['as' => 'resetuser', 'uses' => 'UserController@resetUserView'])->middleware('auth', 'lang', 'admin');
Route::post('/resetusersave', ['as' => 'resetuser_save', 'uses' => 'UserController@resetUser'])->middleware('auth', 'admin');

// Admin Routes For Notices
Route::get('/createnoticeview', ['as' => 'createnoticeview', 'uses' => 'UserController@createnoticeview'])->middleware('auth', 'lang');
Route::post('/sendnotice', ['as' => 'sendnotice', 'uses' => 'UserController@send_notice'])->middleware('auth');
Route::post('/sendnotice', ['as' => 'sendnotice', 'uses' => 'UserController@send_notice'])->middleware('auth');
Route::get('/emails', ['as' => 'emails', 'uses' => 'UserController@email'])->middleware('auth');
Route::post('/addnotice', ['as' => 'addnotice', 'uses' => 'NoticeboardController@addnotice'])->middleware('auth');
Route::post('/deletenotice', ['as' => 'deletenotice', 'uses' => 'NoticeboardController@deletenotice'])->middleware('auth');


// Report Generation Routes
Route::get('/reportgeneration', ['as' => 'reportgeneration', 'uses' => 'UserController@reportgen'])->middleware('auth');
Route::get('/clinicreports', ['as' => 'clinic_reports', 'uses' => 'ReportController@viewclinicreport'])->middleware('auth');
Route::post('/printclinicreports', ['as' => 'print_clinic', 'uses' => 'ReportController@printclinicreport'])->middleware('auth');
Route::get('/mobclinicreport', ['as' => 'mob_clinic_report', 'uses' => 'ReportController@view_mobile_clinic_report'])->middleware('auth');
Route::get('/monstatreport', ['as' => 'mon_stat_report', 'uses' => 'ReportController@view_monthly_static_report'])->middleware('auth','lang');
Route::get('/outpreport', ['as' => 'out_p_report', 'uses' => 'ReportController@view_out_patient_report'])->middleware('auth');
Route::get('/attendancereport', ['as' => 'attendance_report', 'uses' => 'ReportController@view_attendance_report'])->middleware('auth');
Route::get('/wardreport', ['as' => 'ward_report', 'uses' => 'ReportController@view_ward_report'])->middleware('auth');
Route::post('/generatereports', ['as' => 'gen_att_reports', 'uses' => 'ReportController@gen_att_reports'])->middleware('auth');
Route::get('/allprintpreview', ['as' => 'all_print_preview', 'uses' => 'ReportController@all_print_preview'])->middleware('auth');

//Ward Management Routes
Route::get('/wards', ['as' => 'wards', 'uses' => 'WardController@index'])->middleware('auth');
Route::post('/add-ward', ['as' => 'add-ward', 'uses' => 'WardController@createWard'])->middleware('auth');
Route::get('/wards', ['as' => 'wards', 'uses' => 'WardController@index'])->middleware('auth', 'lang');

// Other Routes
Route::get('/herbs', ['as' => 'herbs', 'uses' => 'MedicineController@getherbs']);
Route::get('/wardlist', 'PatientController@get_ward_list');

// Statistics Routes
Route::get('/stats', ['as' => 'stats', 'uses' => 'AnalyticsController@index'])->middleware('doctor', 'admin');
Route::post('/stats-old', ['as' => 'stats_old', 'uses' => 'AnalyticsController@index'])->middleware('doctor', 'admin');
