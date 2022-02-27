<?php

use App\Http\Controllers\EventController;
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
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    });
    Route::get('home', function () {
        return view('home');
    });
});

Auth::routes();

// ----------------------------- main dashboard ------------------------------//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('em/dashboard', [App\Http\Controllers\HomeController::class, 'emDashboard'])->name('em/dashboard');

// -----------------------------settings----------------------------------------//
Route::get('company/settings/page', [App\Http\Controllers\SettingController::class, 'companySettings'])->middleware('auth')->name('company/settings/page');
Route::get('roles/permissions/page', [App\Http\Controllers\SettingController::class, 'rolesPermissions'])->middleware('auth')->name('roles/permissions/page');
Route::post('roles/permissions/save', [App\Http\Controllers\SettingController::class, 'addRecord'])->middleware('auth')->name('roles/permissions/save');
Route::post('roles/permissions/update', [App\Http\Controllers\SettingController::class, 'editRolesPermissions'])->middleware('auth')->name('roles/permissions/update');
Route::post('roles/permissions/delete', [App\Http\Controllers\SettingController::class, 'deleteRolesPermissions'])->middleware('auth')->name('roles/permissions/delete');
Route::get('theme/settings/page', [App\Http\Controllers\SettingController::class, 'themeSettings'])->middleware('auth')->name('theme/settings/page');

// Route::get('settings/change-password', [App\Http\Controllers\SettingController::class, 'changePasswordView'])->middleware('auth')->name('settings/change-password');
// Route::post('settings/update-password', [App\Http\Controllers\SettingController::class, 'changePasswordDB'])->middleware('auth')->name('settings/update-password');

// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ----------------------------- lock screen --------------------------------//
Route::get('lock_screen', [App\Http\Controllers\LockScreen::class, 'lockScreen'])->middleware('auth')->name('lock_screen');
Route::post('unlock', [App\Http\Controllers\LockScreen::class, 'unlock'])->name('unlock');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');
Route::post('/register/user', [App\Http\Controllers\UserController::class, 'storeUser'])->name('register/user');

// ----------------------------- forget password ----------------------------//
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

// ----------------------------- user profile ------------------------------//
Route::get('profile_user', [App\Http\Controllers\UserManagementController::class, 'profile'])->middleware('auth')->name('profile_user');
Route::post('profile/information/save', [App\Http\Controllers\UserManagementController::class, 'profileInformation'])->name('profile/information/save');
Route::post('family/information/save', [App\Http\Controllers\UserManagementController::class, 'createFamilyInfo'])->name('family/information/save');
Route::post('education/information/save', [App\Http\Controllers\UserManagementController::class, 'createEducationInfo'])->name('education/information/save');
Route::post('experience/information/save', [App\Http\Controllers\UserManagementController::class, 'createExperienceInfo'])->middleware('auth')->name('experience/information/save');

// ----------------------------- user userManagement -----------------------//
Route::get('userManagement', [App\Http\Controllers\UserManagementController::class, 'index'])->middleware('auth')->name('userManagement');
Route::post('user/add/save', [App\Http\Controllers\UserManagementController::class, 'addNewUserSave'])->name('user/add/save');
Route::post('search/user/list', [App\Http\Controllers\UserManagementController::class, 'searchUser'])->name('search/user/list');
Route::post('update', [App\Http\Controllers\UserManagementController::class, 'update'])->name('update');
Route::post('user/delete', [App\Http\Controllers\UserManagementController::class, 'delete'])->middleware('auth')->name('user/delete');
Route::get('activity/log', [App\Http\Controllers\UserManagementController::class, 'activityLog'])->middleware('auth')->name('activity/log');
Route::get('activity/login/logout', [App\Http\Controllers\UserManagementController::class, 'activityLogInLogOut'])->middleware('auth')->name('activity/login/logout');

// ----------------------------- search user management ------------------------------//
Route::post('search/user/list', [App\Http\Controllers\UserManagementController::class, 'searchUser'])->name('search/user/list');

// ----------------------------- form change password ------------------------------//
Route::get('change/password', [App\Http\Controllers\UserManagementController::class, 'changePasswordView'])->middleware('auth')->name('change/password');
Route::post('change/password/db', [App\Http\Controllers\UserManagementController::class, 'changePasswordDB'])->name('change/password/db');

// ----------------------------- job ------------------------------//
Route::get('form/job/list', [App\Http\Controllers\JobController::class, 'jobList'])->name('form/job/list');
Route::get('form/job/view', [App\Http\Controllers\JobController::class, 'jobView'])->name('form/job/view');

// ----------------------------- form employee ------------------------------//
Route::get('all/employee/card', [App\Http\Controllers\EmployeeController::class, 'cardAllEmployee'])->middleware('auth')->name('all/employee/card');
Route::get('all/employee/list', [App\Http\Controllers\EmployeeController::class, 'listAllEmployee'])->middleware('auth')->name('all/employee/list');
Route::post('all/employee/save', [App\Http\Controllers\EmployeeController::class, 'saveRecord'])->middleware('auth')->name('all/employee/save');
Route::get('all/employee/view/edit/{employee_id}', [App\Http\Controllers\EmployeeController::class, 'viewRecord'])->middleware('auth');
Route::post('all/employee/update', [App\Http\Controllers\EmployeeController::class, 'updateRecord'])->middleware('auth')->name('all/employee/update');
Route::post('all/employee/delete', [App\Http\Controllers\EmployeeController::class, 'deleteRecord'])->middleware('auth')->name('all/employee/delete');
Route::post('all/employee/search', [App\Http\Controllers\EmployeeController::class, 'employeeSearch'])->name('all/employee/search');
Route::post('all/employee/list/search', [App\Http\Controllers\EmployeeController::class, 'employeeListSearch'])->name('all/employee/list/search');

// ------------------------------ form department ---------------------------------//
Route::get('form/department/new', [App\Http\Controllers\DepartmentController::class, 'allDepartmet'])->middleware('auth')->name('form/department/new');
Route::post('form/department/save', [App\Http\Controllers\DepartmentController::class, 'saveDepartment'])->middleware('auth')->name('form/department/save');
Route::post('form/department/update', [App\Http\Controllers\DepartmentController::class, 'updateDepartment'])->middleware('auth')->name('form/department/update');
Route::post('form/department/delete', [App\Http\Controllers\DepartmentController::class, 'deleteDepartment'])->middleware('auth')->name('form/department/delete');

// ----------------------------- profile employee ------------------------------//
Route::get('employee/profile/{rec_id}', [App\Http\Controllers\EmployeeController::class, 'profileEmployee'])->middleware('auth');

// ----------------------------- form holiday ------------------------------//
Route::get('form/holidays/new', [App\Http\Controllers\HolidayController::class, 'holiday'])->middleware('auth')->name('form/holidays/new');
Route::post('form/holidays/save', [App\Http\Controllers\HolidayController::class, 'saveRecord'])->middleware('auth')->name('form/holidays/save');
Route::post('form/holidays/update', [App\Http\Controllers\HolidayController::class, 'updateRecord'])->middleware('auth')->name('form/holidays/update');
Route::post('form/holidays/delete', [App\Http\Controllers\HolidayController::class, 'deleteRecord'])->middleware('auth')->name('form/holidays/delete');

// ----------------------------- form leaves Admin------------------------------//
Route::get('form/leaves/new', [App\Http\Controllers\LeavesController::class, 'leaves'])->middleware('auth')->name('form/leaves/new');
Route::post('form/leaves/save', [App\Http\Controllers\LeavesController::class, 'saveRecord'])->middleware('auth')->name('form/leaves/save');
Route::post('form/leaves/edit', [App\Http\Controllers\LeavesController::class, 'editRecordLeave'])->middleware('auth')->name('form/leaves/edit');
Route::post('form/leaves/edit/delete', [App\Http\Controllers\LeavesController::class, 'deleteLeave'])->middleware('auth')->name('form/leaves/edit/delete');
Route::post('form/leaves/search', [App\Http\Controllers\LeavesController::class, 'searchLeave'])->middleware('auth')->name('form/leaves/search');

// ----------------------------- form leaves Admin Status------------------------------//
Route::post('form/leaves/status', [App\Http\Controllers\LeavesController::class, 'statusLeave'])->middleware('auth')->name('form/leaves/status');

// ----------------------------- form leaves Employee------------------------------//
Route::get('form/leavesemployee/new', [App\Http\Controllers\LeavesController::class, 'leavesEmployee'])->middleware('auth')->name('form/leavesemployee/new');
Route::post('form/leavesemployee/delete', [App\Http\Controllers\LeavesController::class, 'deleteLeavesEmployee'])->middleware('auth')->name('form/leavesemployee/delete');

// ----------------------------- form leaves Type ------------------------------//
Route::get('form/leavetypes/page', [App\Http\Controllers\LeavesController::class, 'leaveTypes'])->middleware('auth')->name('form/leavetypes/page');
Route::post('form/leavetypes/add', [App\Http\Controllers\LeavesController::class, 'saveLeaveTypes'])->middleware('auth')->name('form/leavetypes/add');
Route::get('form/leavetypes/delete/{leave_id}', [App\Http\Controllers\LeavesController::class, 'deleteTypes'])->middleware('auth');
Route::get('form/leavetypes/edit/{leave_id}', [App\Http\Controllers\LeavesController::class, 'editLeaveTypes'])->middleware('auth');

// ----------------------------- form attendance  ------------------------------//
Route::get('form/shiftscheduling/page', [App\Http\Controllers\LeavesController::class, 'shiftScheduLing'])->middleware('auth')->name('form/shiftscheduling/page');
Route::get('form/shiftlist/page', [App\Http\Controllers\LeavesController::class, 'shiftList'])->middleware('auth')->name('form/shiftlist/page');

// ----------------------------- Clients ------------------------------//
Route::get('clients/clients', [App\Http\Controllers\ClientsController::class, 'clients'])->middleware('auth')->name('clients/clients');
Route::post('clients/new', [App\Http\Controllers\ClientsController::class, 'saveRecordClient'])->middleware('auth')->name('clients/new');
Route::post('clients/delete', [App\Http\Controllers\ClientsController::class, 'deleteClient'])->middleware('auth')->name('clients/delete');
Route::post('clients/edit', [App\Http\Controllers\ClientsController::class, 'editClient'])->middleware('auth')->name('clients/edit');
Route::get('clients/client-profile/{client_id}', [App\Http\Controllers\ClientsController::class, 'clientProfile'])->middleware('auth')->name('clients/client-profile');
Route::get('clients/clients-list', [App\Http\Controllers\ClientsController::class, 'clientsList'])->middleware('auth')->name('clients/clients-list');

// ----------------------------- Locations ------------------------------//
Route::get('location/locations', [App\Http\Controllers\LocationController::class, 'location'])->middleware('auth')->name('location/locations');
Route::post('/location/new', [App\Http\Controllers\LocationController::class, 'storeLocation'])->middleware('auth')->name('location/new');
Route::get('location/locations/profile/{id}', [App\Http\Controllers\LocationController::class, 'locationProfile'])->middleware('auth')->name('location/locations/profile');
Route::post('location/edit', [App\Http\Controllers\LocationController::class, 'locationEdit'])->middleware('auth')->name('location/edit');
Route::post('location/delete', [App\Http\Controllers\locationController::class, 'locationDelete'])->middleware('auth')->name('location/delete');
Route::get('location/locations/list', [App\Http\Controllers\LocationController::class, 'locationList'])->middleware('auth')->name('location/locations/list');
// ----------------------------- Locations Dapartament------------------------------//
Route::post('location/type/add', [App\Http\Controllers\LocationTypeWorkController::class, 'create'])->middleware('auth')->name('location/type/add');
Route::post('location/type/edit', [App\Http\Controllers\LocationTypeWorkController::class, 'edit'])->middleware('auth')->name('location/type/edit');
Route::post('location/type/delete', [App\Http\Controllers\LocationTypeWorkController::class, 'delete'])->middleware('auth')->name('location/type/delete');
// ----------------------------- Find Possible Employees------------------------------//
Route::get('location/profile/find/{id}', [App\Http\Controllers\FindEmployees::class, 'find'])->middleware('auth')->name('location/profile/find');
Route::post('location/profile/assignment/{id}', [App\Http\Controllers\FindEmployees::class, 'assignment'])->middleware('auth')->name('location/profile/assignment');

// ----------------------------- form payroll  ------------------------------//
Route::get('form/salary/page', [App\Http\Controllers\PayrollController::class, 'salary'])->middleware('auth')->name('form/salary/page');
Route::post('form/salary/save', [App\Http\Controllers\PayrollController::class, 'saveRecord'])->middleware('auth')->name('form/salary/save');
Route::post('form/salary/update', [App\Http\Controllers\PayrollController::class, 'updateRecord'])->middleware('auth')->name('form/salary/update');
Route::post('form/salary/delete', [App\Http\Controllers\PayrollController::class, 'deleteRecord'])->middleware('auth')->name('form/salary/delete');
Route::get('form/salary/view/{rec_id}', [App\Http\Controllers\PayrollController::class, 'salaryView'])->middleware('auth');
Route::get('form/payroll/items', [App\Http\Controllers\PayrollController::class, 'payrollItems'])->middleware('auth')->name('form/payroll/items');

// ----------------------------- reports  ------------------------------//
Route::get('form/expense/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'index'])->middleware('auth')->name('form/expense/reports/page');
Route::get('form/invoice/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'invoiceReports'])->middleware('auth')->name('form/invoice/reports/page');
Route::get('form/invoice/view/page', [App\Http\Controllers\ExpenseReportsController::class, 'invoiceView'])->middleware('auth')->name('form/invoice/view/page');
Route::get('form/daily/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'dailyReport'])->middleware('auth')->name('form/daily/reports/page');
Route::get('form/leave/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'leaveReport'])->middleware('auth')->name('form/leave/reports/page');

// ----------------------------- performance  ------------------------------//
Route::get('form/performance/indicator/page', [App\Http\Controllers\PerformanceController::class, 'index'])->middleware('auth')->name('form/performance/indicator/page');
Route::get('form/performance/page', [App\Http\Controllers\PerformanceController::class, 'performance'])->middleware('auth')->name('form/performance/page');
Route::get('form/performance/appraisal/page', [App\Http\Controllers\PerformanceController::class, 'performanceAppraisal'])->middleware('auth')->name('form/performance/appraisal/page');
Route::post('form/performance/indicator/save', [App\Http\Controllers\PerformanceController::class, 'saveRecordIndicator'])->middleware('auth')->name('form/performance/indicator/save');
Route::post('form/performance/indicator/delete', [App\Http\Controllers\PerformanceController::class, 'deleteIndicator'])->middleware('auth')->name('form/performance/indicator/delete');
Route::post('form/performance/indicator/update', [App\Http\Controllers\PerformanceController::class, 'updateIndicator'])->middleware('auth')->name('form/performance/indicator/update');

Route::post('form/performance/appraisal/save', [App\Http\Controllers\PerformanceController::class, 'saveRecordAppraisal'])->middleware('auth')->name('form/performance/appraisal/save');
Route::post('form/performance/appraisal/update', [App\Http\Controllers\PerformanceController::class, 'updateAppraisal'])->middleware('auth')->name('form/performance/appraisal/update');
Route::post('form/performance/appraisal/delete', [App\Http\Controllers\PerformanceController::class, 'deleteAppraisal'])->middleware('auth')->name('form/performance/appraisal/delete');

// ----------------------------- training  ------------------------------//
Route::get('form/training/list/page', [App\Http\Controllers\TrainingController::class, 'index'])->middleware('auth')->name('form/training/list/page');
Route::post('form/training/save', [App\Http\Controllers\TrainingController::class, 'addNewTraining'])->middleware('auth')->name('form/training/save');
Route::post('form/training/delete', [App\Http\Controllers\TrainingController::class, 'deleteTraining'])->middleware('auth')->name('form/training/delete');
Route::post('form/training/update', [App\Http\Controllers\TrainingController::class, 'updateTraining'])->middleware('auth')->name('form/training/update');

// ----------------------------- trainers  ------------------------------//
Route::get('form/trainers/list/page', [App\Http\Controllers\TrainersController::class, 'index'])->middleware('auth')->name('form/trainers/list/page');
Route::post('form/trainers/save', [App\Http\Controllers\TrainersController::class, 'saveRecord'])->middleware('auth')->name('form/trainers/save');
Route::post('form/trainers/update', [App\Http\Controllers\TrainersController::class, 'updateRecord'])->middleware('auth')->name('form/trainers/update');
Route::post('form/trainers/delete', [App\Http\Controllers\TrainersController::class, 'deleteRecord'])->middleware('auth')->name('form/trainers/delete');

// ----------------------------- Company Settings ------------------------------//
Route::get('company/store', [App\Http\Controllers\CompanyInfoController::class, 'CompanyStore'])->middleware('auth')->name('company/store');
Route::post('company/settings', [App\Http\Controllers\CompanyInfoController::class, 'CompanySettings'])->middleware('auth')->name('company/settings');

// ----------------------------- Theme Settings ------------------------------//
Route::get('theme/settings', [App\Http\Controllers\ThemeSettingsController::class, 'WebsiteStore'])->middleware('auth')->name('theme/settings');
Route::post('theme/store', [App\Http\Controllers\ThemeSettingsController::class, 'WebsiteSettings'])->middleware('auth')->name('theme/store');

// ----------------------------- Clock Settings ------------------------------//
Route::get('timeclock/settings', [App\Http\Controllers\ClockTimeSettingsController::class, 'index'])->middleware('auth')->name('timeclock/settings');
Route::post('timeclock/update', [App\Http\Controllers\ClockTimeSettingsController::class, 'update'])->middleware('auth')->name('timeclock/update');

// ----------------------------- TimeClock/Attendance -----------------------------------//
Route::get('employee/attendance', [App\Http\Controllers\TimeClockController::class, 'clock'])->middleware('auth')->name('employee/attendance');
Route::post('attendance/add', [App\Http\Controllers\TimeClockController::class, 'add'])->middleware('auth')->name('attendance/add');
Route::post('attendance/search', [App\Http\Controllers\TimeClockController::class, 'search'])->middleware('auth')->name('attendance/search');
Route::get('attendance/page', [App\Http\Controllers\AdminAttendance::class, 'AdminAttendance'])->middleware('auth')->name('attendance/page');
Route::post('attendance/page/search', [App\Http\Controllers\AdminAttendance::class, 'attSearch'])->middleware('auth')->name('attendance/page/search');
Route::post('attendance/page/manual-entrance', [App\Http\Controllers\AdminAttendance::class, 'manualEntrance'])->middleware('auth')->name('attendance/page/manual-entrance');
Route::post('attendance/page/edit', [App\Http\Controllers\AdminAttendance::class, 'edit'])->middleware('auth')->name('attendance/page/edit');
Route::post('attendance/page/delete', [App\Http\Controllers\AdminAttendance::class, 'delete'])->middleware('auth')->name('attendance/page/delete');

// ---------------------------------- App--------------------------------------------------------//
// Route::get('/show-event-calendar', [EventController::class, 'index']);
// Route::post('/manage-events', [EventController::class, 'manageEvents']);
// Route::get('ckeditor', [EventController::class, 'index']);
// Route::post('fullcalendar/create', [EventController::class, 'create']);
// Route::post('fullcalendar/update', [EventController::class, 'update']);
// Route::post('fullcalendar/delete', [EventController::class, 'destroy']);

Route::get('fullcalender', [EventController::class, 'index']);
Route::post('fullcalenderAjax', [EventController::class, 'ajax']);
