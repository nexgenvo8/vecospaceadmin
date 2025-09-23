<?php


use App\Http\Controllers\UserAdminController;
use App\Http\Middleware\AdminSessionTimeout;
use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', fn() => view('welcome'));
Route::get('/login', fn() => view('login'))->name('loginform');
Route::post('/adminlogin', [UserAdminController::class, 'login'])->name('submitLogin');
Route::get('masteradmin/manage-faqs', fn() => view('manage_faq'));
// Protected routes with AdminSessionTimeout middleware
Route::middleware([AdminSessionTimeout::class])->group(function () {

    Route::get('/dashboard', [UserAdminController::class, 'index'])->name('index');
    Route::get('/logout', [UserAdminController::class, 'logout'])->name('logout');
    Route::get('/index', [UserAdminController::class, 'recordCount'])->name('index');

    Route::get('/profile', [UserAdminController::class, 'viewProfile'])->name('profile.view');
    Route::post('/profile/update', [UserAdminController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/update-password', [UserAdminController::class, 'updateNewPassword'])->name('profile.updatePassword');

    Route::post('usermaster/resendemail', [UserAdminController::class, 'resendEmail'])->name('resend_email');



    Route::middleware([CheckPermission::class . ':import_userdata'])->group(function () {
        Route::post('user/user/import', [UserAdminController::class, 'importedUsers'])->name('import.upload');
        Route::get('user/import_userdata', fn() => view('import_userdata'))->name('import.form');
    });



    Route::middleware([CheckPermission::class . ':subscription_list'])->group(function () {
        Route::get('users/subscription_list', [UserAdminController::class, 'userList'])->name(name: 'user_subscription_list');
    });


    Route::post('user/user/updatestatus', [UserAdminController::class, 'updateUserStatus'])->name('user.updatestatus');
    Route::post('user/user/update', [UserAdminController::class, 'updateUser'])->name('user.update');

    // Group routes
    Route::middleware([CheckPermission::class . ':group_list'])->group(function () {
        Route::get('group/group_list', [UserAdminController::class, 'groups'])->name('group_list');
        Route::post('group/update', [UserAdminController::class, 'updateGroupStatus'])->name('group.update');
    });

    // Company routes
    Route::middleware([CheckPermission::class . ':company_list'])->group(function () {
        Route::get('company/company_list', [UserAdminController::class, 'company'])->name('company_list');
        Route::post('company/update', [UserAdminController::class, 'updatecompanylist'])->name('company.update');
    });

    // Role Permissions

    Route::middleware([CheckPermission::class . ':roles_permissions_list'])->group(function () {
        Route::get('permissions/roles-permissions', [UserAdminController::class, 'rolePermission'])
            ->name('roles_permissions_list');

        Route::post('role_permission/update', [UserAdminController::class, 'updaterolePermission'])
            ->name('roles_permissions.store');

        Route::get('edit-permissions/edit-roles-permissions', [UserAdminController::class, 'editrolePermission'])
            ->name('view_edit_permissions');
    });

    // Articles
    Route::middleware([CheckPermission::class . ':article_list'])->group(function () {
        Route::get('article/article_list', [UserAdminController::class, 'articleList'])->name('article_list');
        Route::post('article/article/update', [UserAdminController::class, 'updateArticleStatus'])->name('article.update');
    });

    // Event Calendar
    Route::middleware([CheckPermission::class . ':events_list'])->group(function () {
        Route::get('event/events_list', [UserAdminController::class, 'eventCalender'])->name('event_list');
        Route::post('event/event/update', [UserAdminController::class, 'updateEventStatus'])->name('event.update');
    });

    // Projects
    Route::middleware([CheckPermission::class . ':project_list'])->group(function () {
        Route::get('project/project_list', [UserAdminController::class, 'projectList'])->name('project_list');
        Route::post('project/project/update', [UserAdminController::class, 'updateProjectStatus'])->name('project.update');
    });

    // Career Enhancers
    Route::middleware([CheckPermission::class . ':career_enhancers'])->group(function () {
        Route::get('career/career_enhancers', [UserAdminController::class, 'careerEnhancers'])->name('career_enhancer_list');
        Route::post('update/career_enhancers', [UserAdminController::class, 'updatecareerEnhancers'])->name('career.careerenhancers');
    });

    // Talent / Guest Speakers
    Route::middleware([CheckPermission::class . ':talent_list'])->group(function () {
        Route::get('talent/talent_list', [UserAdminController::class, 'talentList'])->name('talent_list');
        Route::post('talent/talent/update', [UserAdminController::class, 'updateTalentStatus'])->name('talent.update');
    });

    // Jobs
    Route::middleware([CheckPermission::class . ':job_list'])->group(function () {
        Route::get('job/job_list', [UserAdminController::class, 'jobList'])->name('job_list');
        Route::post('job/job/update', [UserAdminController::class, 'updateJobStatus'])->name('job.update');
    });

    // Posts
    Route::middleware([CheckPermission::class . ':posts_list'])->group(function () {
        Route::get('posts/posts_list', [UserAdminController::class, 'postList'])->name('post_list');
        Route::post('posts/post/update', [UserAdminController::class, 'updatePostStatus'])->name('post.update');
    });

    // Contacts
    Route::middleware([CheckPermission::class . ':list_contact_query'])->group(function () {
        Route::get('contactus/list_contact_query', [UserAdminController::class, 'contactUsList'])->name('contact_list');
        Route::post('contactus/contact/update', [UserAdminController::class, 'updateContactStatus'])->name('contact.update');
    });

    // Notice Board
    Route::middleware([CheckPermission::class . ':manage_notice'])->group(function () {
        Route::get('notice-board/manage_notice', [UserAdminController::class, 'noticeBoardList'])->name('manage_notice');
        Route::post('notice-board/noticeboard/store', [UserAdminController::class, 'storeNoticeboard'])->name('noticeboard.store');
        Route::post('notice-board/noticeboard/update', [UserAdminController::class, 'updateNoticeBoard'])->name('noticeboard.update');
    });

    Route::get('/permissions_list', [UserAdminController::class, 'permissionsList'])
        ->name('permissions_list');

    // Protected routes with permission middleware


    Route::middleware([CheckPermission::class . ':manage_course'])->group(function () {
        Route::get('course/manage_course', [UserAdminController::class, 'manageCourse'])->name('manage_course');
        Route::post('course/course/store', [UserAdminController::class, 'storeCourse'])->name('course.store');
        Route::post('course/course/update', [UserAdminController::class, 'updateCourse'])->name('course.update');
    });



    Route::middleware([CheckPermission::class . ':manage_department'])->group(function () {
        Route::get('department/manage_department', [UserAdminController::class, 'departmentList'])->name('manage_department');
        Route::post('department/department/store', [UserAdminController::class, 'storeDepartment'])->name('department.store');
        Route::post('department/department/update', [UserAdminController::class, 'updateDepartment'])->name('department.update');
    });


    // Jobfair / Placement Registration
    Route::middleware([CheckPermission::class . ':manage_jobfair'])->group(function () {
        Route::get('register/manage_jobfair', [UserAdminController::class, 'registrationList'])->name('registration_list');
    });

    // Menu Pages Management
    Route::middleware([CheckPermission::class . ':manage_menu_pages'])->group(function () {
        Route::get('pages/manage-page', [UserAdminController::class, 'menuPages'])->name('manupageslist');
        Route::post('pages/manage-page-update', [UserAdminController::class, 'updateMenuPages'])->name('pages.update');
        Route::post('pages/manage-page-statusupdate', [UserAdminController::class, 'updateMenuPageStatus'])->name('pagesstatus.update');
        Route::post('pages/manage-page-create', [UserAdminController::class, 'createMenuPages'])->name('pages.create');
        Route::post('pages/manage-page-delete', [UserAdminController::class, 'deleteMenuPages'])->name('pages.delete');
    });

    // FAQ Pages Management
    Route::middleware([CheckPermission::class . ':manage_faqs_pages'])->group(function () {
        Route::get('pages/manage-faqs', [UserAdminController::class, 'mangefaqs'])->name('faqpageslist');
        Route::post('pages/manage-page-faqupdate', [UserAdminController::class, 'updateFaqPages'])->name('faqpages.update');
        Route::post('faqs/manage-faqspage-statusupdate', [UserAdminController::class, 'updateFaqPageStatus'])->name('faqpagesstatus.update');
        Route::post('faqs/manage-faqspage-createed', [UserAdminController::class, 'faqCreatedPages'])->name('faqpages_createed');
        Route::post('pages/manage-faqspage-delete', [UserAdminController::class, 'deleteFaqPages'])->name('faqpages.delete');
    });


});


