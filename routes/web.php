<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserAdminController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});
Route::get('masteradmin/manage-pages', function () {
    return view('manage_page');
});

Route::get('masteradmin/manage-faqs', function () {
    return view('manage_faq');
});

Route::get('masteradmin/subscription_list', function () {
    return view('subscription_list');
});

Route::get('masteradmin/import_userdata', function () {
    return view('import_userdata');
});



// Profile page route
Route::get('/profile', [UserAdminController::class, 'viewProfile'])->name('profile.view');
Route::post('/profile/update', [UserAdminController::class, 'updateProfile'])->name('profile.update');

// Password update route
Route::post('/profile/update-password', [UserAdminController::class, 'updateNewPassword'])->name('profile.updatePassword');


Route::get('masteradmin/group_list', [UserAdminController::class, 'groups'])->name('group_list');
;
Route::post('masteradmin/group/update', [UserAdminController::class, 'updateGroupStatus'])->name('group.update');



Route::get('masteradmin/company_list', [UserAdminController::class, 'company'])->name('company_list');
;
Route::post('masteradmin/company/update', [UserAdminController::class, 'updatecompanylist'])->name('company.update');



Route::get('masteradmin/article_list', [UserAdminController::class, 'articleList'])->name('article_list');
Route::post('masteradmin/article/update', [UserAdminController::class, 'updateArticleStatus'])->name('article.update');


Route::get('masteradmin/events_list', [UserAdminController::class, 'eventCalender'])->name('event_list');
Route::post('masteradmin/event/update', [UserAdminController::class, 'updateEventStatus'])->name('event.update');



Route::get('masteradmin/project_list', [UserAdminController::class, 'projectList'])->name('project_list');
Route::post('masteradmin/project/update', [UserAdminController::class, 'updateProjectStatus'])->name('project.update');

Route::get('masteradmin/career_enhancers', [UserAdminController::class, 'careerEnhancers'])->name('career_enhancer_list');
Route::post('masteradmin/update/career_enhancers', [UserAdminController::class, 'updatecareerEnhancers'])->name('career.careerenhancers');


Route::get('masteradmin/talent_list', [UserAdminController::class, 'talentList'])->name('talent_list');
Route::post('masteradmin/talent/update', [UserAdminController::class, 'updateTalentStatus'])->name('talent.update');


Route::get('masteradmin/job_list', [UserAdminController::class, 'jobList'])->name('job_list');
Route::post('masteradmin/job/update', [UserAdminController::class, 'updateJobStatus'])->name('job.update');



Route::get('masteradmin/posts_list', [UserAdminController::class, 'postList'])->name('post_list');
Route::post('masteradmin/post/update', [UserAdminController::class, 'updatePostStatus'])->name('post.update');

Route::get('masteradmin/list_contact_query', [UserAdminController::class, 'contactUsList'])->name('contact_list');
Route::post('masteradmin/contact/update', [UserAdminController::class, 'updateContactStatus'])->name('contact.update');




Route::get('masteradmin/manage_department', [UserAdminController::class, 'departmentListData']);
Route::get('masteradmin/manage_jobfair', [UserAdminController::class, 'registrationList']);

Route::get('masteradmin/manage_notice', [UserAdminController::class, 'noticeBoardList'])->name('manage_notice');
Route::post('masteradmin/noticeboard/store', [UserAdminController::class, 'storeNoticeboard'])->name('noticeboard.store');
Route::post('masteradmin/noticeboard/update', [UserAdminController::class, 'updateNoticeBoard'])->name('noticeboard.update');


Route::get('masteradmin/manage_department', [UserAdminController::class, 'departmentList'])->name('manage_department');
Route::post('masteradmin/department/store', [UserAdminController::class, 'storeDepartment'])->name('department.store');
Route::post('masteradmin/department/update', [UserAdminController::class, 'updateDepartment'])->name('department.update');



Route::get('masteradmin/manage_course', [UserAdminController::class, 'manageCourse'])->name('manage_course');
Route::post('masteradmin/course/store', [UserAdminController::class, 'storeCourse'])->name('course.store');
Route::post('masteradmin/course/update', [UserAdminController::class, 'updateCourse'])->name('course.update');



Route::get('loginform', function () {
    return view('login');
})->name('loginform');
;


Route::post('/adminlogin', [UserAdminController::class, 'login'])->name('submitLogin');
Route::get('/logout', [UserAdminController::class, 'logout'])->name('logout');
Route::get('/index', [UserAdminController::class, 'index'])->name('index');





