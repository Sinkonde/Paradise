<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('layout', function () {
    return view('layouts.lay');
});

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pdf', [\App\Http\Controllers\HomeController::class, 'pdf'])->name('home.pdf');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('students', 'StudentController');
    Route::resource('parents', 'StudentGuardianController');
    Route::resource('members', 'ClassMemberController');
    Route::resource('levels', 'LevelController');
    Route::resource('grades', 'GradeController');
    Route::resource('streams', 'StreamController');
    Route::resource('academic-years', 'AcademicYearController');
    Route::resource('classes', 'ClasController');
    Route::resource('subjects', 'SubjectController');
    Route::resource('depertments', 'DepertmentController');
    Route::resource('workers', 'WorkerController');
    Route::resource('titles', 'LeaderTitleController');
    Route::resource('teachers', 'TeacherController');
    Route::resource('level-subjects', 'LevelSubjectController');
    Route::resource('class-subjects', 'ClassSubjectController');
    Route::resource('subject-teachers', 'SubjectTeacherController');
    Route::resource('exams', 'ExamController');
    Route::resource('marks', 'MarkController');
    Route::resource('routes', 'DayscholarRouteController');
    Route::resource('dayscholars', 'DayscholarController');
    Route::resource('vacations', 'VacationStudentController');
    Route::resource('users', 'UserController');
    Route::resource('user-phones', 'UserPhoneController');
    Route::resource('fees-categories', 'FeesCategoryController');
    Route::resource('fees-category-years', 'FeesCategoryYearController');
    Route::resource('route-years', 'DayscholarRouteYearController');
    Route::resource('fees', 'FeesController');
    Route::resource('fees-structures', 'FeeStructureController');
    Route::resource('student-reports', 'StudentReportController');

    //excel templates
    Route::get('export/results', 'ExportController@resultTemplate')->name('result.template');
    Route::get('remedial_collection_template/{class}', 'ExportController@remedialCollectionTemplate')->name('remedial.template');

    //mails
    Route::get('send-results', 'SendEmailToUsersController@sendExamResultsToOneSubscriber')->name('mail.send_results');
    Route::get('send-results-to-all', 'SendEmailToUsersController@sendExamResultsToAllSubscribers')->name('mail.send_results_to_all');

    //Reports
    Route::get('mkeka-pdf', 'ReportPDF@mkeka')->name('mkeka-pdf');

});
//
