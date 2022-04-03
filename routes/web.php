<?php

use App\Http\Controllers\AdminAttendance;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ClockTimeSettingsController;
use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseReportsController;
use App\Http\Controllers\FindEmployees;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidentReportController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationTypeWorkController;
use App\Http\Controllers\LockScreen;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ThemeSettingsController;
use App\Http\Controllers\TimeClockController;
use App\Http\Controllers\TrainersController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
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
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('em/dashboard', [HomeController::class, 'emDashboard'])->name('em/dashboard');

// -----------------------------settings----------------------------------------//
Route::get('company/settings/page', [SettingController::class, 'companySettings'])->middleware('auth')->name('company/settings/page');
Route::get('roles/permissions/page', [SettingController::class, 'rolesPermissions'])->middleware('auth')->name('roles/permissions/page');
Route::post('roles/permissions/save', [SettingController::class, 'addRecord'])->middleware('auth')->name('roles/permissions/save');
Route::post('roles/permissions/update', [SettingController::class, 'editRolesPermissions'])->middleware('auth')->name('roles/permissions/update');
Route::post('roles/permissions/delete', [SettingController::class, 'deleteRolesPermissions'])->middleware('auth')->name('roles/permissions/delete');
Route::get('theme/settings/page', [SettingController::class, 'themeSettings'])->middleware('auth')->name('theme/settings/page');

// Route::get('settings/change-password', [SettingController::class, 'changePasswordView'])->middleware('auth')->name('settings/change-password');
// Route::post('settings/update-password', [SettingController::class, 'changePasswordDB'])->middleware('auth')->name('settings/update-password');

// -----------------------------login----------------------------------------//
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ----------------------------- lock screen --------------------------------//
Route::get('lock_screen', [LockScreen::class, 'lockScreen'])->middleware('auth')->name('lock_screen');
Route::post('unlock', [LockScreen::class, 'unlock'])->name('unlock');

// ------------------------------ register ---------------------------------//
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'storeUser'])->name('register');
Route::post('/register/user', [UserController::class, 'storeUser'])->name('register/user');

// ----------------------------- forget password ----------------------------//
Route::get('forget-password', [ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-password', [ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [ResetPasswordController::class, 'updatePassword']);

// ----------------------------- user profile ------------------------------//
Route::get('profile_user', [UserManagementController::class, 'profile'])->middleware('auth')->name('profile_user');
Route::post('profile/information/save', [UserManagementController::class, 'profileInformation'])->name('profile/information/save');
Route::post('family/information/save', [UserManagementController::class, 'createFamilyInfo'])->name('family/information/save');
Route::post('education/information/save', [UserManagementController::class, 'createEducationInfo'])->name('education/information/save');
Route::post('experience/information/save', [UserManagementController::class, 'createExperienceInfo'])->middleware('auth')->name('experience/information/save');

// ----------------------------- user userManagement -----------------------//
Route::get('userManagement', [UserManagementController::class, 'index'])->middleware('auth')->name('userManagement');
Route::post('user/add/save', [UserManagementController::class, 'addNewUserSave'])->name('user/add/save');
Route::post('search/user/list', [UserManagementController::class, 'searchUser'])->name('search/user/list');
Route::post('update', [UserManagementController::class, 'update'])->name('update');
Route::post('user/delete', [UserManagementController::class, 'delete'])->middleware('auth')->name('user/delete');
Route::get('activity/log', [UserManagementController::class, 'activityLog'])->middleware('auth')->name('activity/log');
Route::get('activity/login/logout', [UserManagementController::class, 'activityLogInLogOut'])->middleware('auth')->name('activity/login/logout');

// ----------------------------- search user management ------------------------------//
Route::post('search/user/list', [UserManagementController::class, 'searchUser'])->name('search/user/list');

// ----------------------------- form change password ------------------------------//
Route::get('change/password', [UserManagementController::class, 'changePasswordView'])->middleware('auth')->name('change/password');
Route::post('change/password/db', [UserManagementController::class, 'changePasswordDB'])->name('change/password/db');

// ----------------------------- job ------------------------------//
Route::get('form/job/list', [JobController::class, 'jobList'])->name('form/job/list');
Route::get('form/job/view', [JobController::class, 'jobView'])->name('form/job/view');

// ----------------------------- form employee ------------------------------//
Route::get('all/employee/card', [EmployeeController::class, 'cardAllEmployee'])->middleware('auth')->name('all/employee/card');
Route::get('all/employee/list', [EmployeeController::class, 'listAllEmployee'])->middleware('auth')->name('all/employee/list');
Route::post('all/employee/save', [EmployeeController::class, 'saveRecord'])->middleware('auth')->name('all/employee/save');
Route::get('all/employee/view/edit/{employee_id}', [EmployeeController::class, 'viewRecord'])->middleware('auth');
Route::post('all/employee/update', [EmployeeController::class, 'updateRecord'])->middleware('auth')->name('all/employee/update');
Route::post('all/employee/delete', [EmployeeController::class, 'deleteRecord'])->middleware('auth')->name('all/employee/delete');
Route::post('all/employee/search', [EmployeeController::class, 'employeeSearch'])->name('all/employee/search');
Route::post('all/employee/list/search', [EmployeeController::class, 'employeeListSearch'])->name('all/employee/list/search');

// ------------------------------ form department ---------------------------------//
Route::get('form/department/new', [DepartmentController::class, 'allDepartmet'])->middleware('auth')->name('form/department/new');
Route::post('form/department/save', [DepartmentController::class, 'saveDepartment'])->middleware('auth')->name('form/department/save');
Route::post('form/department/update', [DepartmentController::class, 'updateDepartment'])->middleware('auth')->name('form/department/update');
Route::post('form/department/delete', [DepartmentController::class, 'deleteDepartment'])->middleware('auth')->name('form/department/delete');

// ----------------------------- profile employee ------------------------------//
Route::get('employee/profile/{rec_id}', [EmployeeController::class, 'profileEmployee'])->middleware('auth');

// ----------------------------- form holiday ------------------------------//
Route::get('form/holidays/new', [HolidayController::class, 'holiday'])->middleware('auth')->name('form/holidays/new');
Route::post('form/holidays/save', [HolidayController::class, 'saveRecord'])->middleware('auth')->name('form/holidays/save');
Route::post('form/holidays/update', [HolidayController::class, 'updateRecord'])->middleware('auth')->name('form/holidays/update');
Route::post('form/holidays/delete', [HolidayController::class, 'deleteRecord'])->middleware('auth')->name('form/holidays/delete');

// ----------------------------- form leaves Admin------------------------------//
Route::get('form/leaves/new', [LeavesController::class, 'leaves'])->middleware('auth')->name('form/leaves/new');
Route::post('form/leaves/save', [LeavesController::class, 'saveRecord'])->middleware('auth')->name('form/leaves/save');
Route::post('form/leaves/edit', [LeavesController::class, 'editRecordLeave'])->middleware('auth')->name('form/leaves/edit');
Route::post('form/leaves/edit/delete', [LeavesController::class, 'deleteLeave'])->middleware('auth')->name('form/leaves/edit/delete');
Route::post('form/leaves/search', [LeavesController::class, 'searchLeave'])->middleware('auth')->name('form/leaves/search');

// ----------------------------- form leaves Admin Status------------------------------//
Route::post('form/leaves/status', [LeavesController::class, 'statusLeave'])->middleware('auth')->name('form/leaves/status');

// ----------------------------- form leaves Employee------------------------------//
Route::get('form/leavesemployee/new', [LeavesController::class, 'leavesEmployee'])->middleware('auth')->name('form/leavesemployee/new');
Route::post('form/leavesemployee/delete', [LeavesController::class, 'deleteLeavesEmployee'])->middleware('auth')->name('form/leavesemployee/delete');

// ----------------------------- form leaves Type ------------------------------//
Route::get('form/leavetypes/page', [LeavesController::class, 'leaveTypes'])->middleware('auth')->name('form/leavetypes/page');
Route::post('form/leavetypes/add', [LeavesController::class, 'saveLeaveTypes'])->middleware('auth')->name('form/leavetypes/add');
Route::get('form/leavetypes/delete/{leave_id}', [LeavesController::class, 'deleteTypes'])->middleware('auth');
Route::get('form/leavetypes/edit/{leave_id}', [LeavesController::class, 'editLeaveTypes'])->middleware('auth');

// ----------------------------- form attendance  ------------------------------//
Route::get('form/shiftscheduling/page', [LeavesController::class, 'shiftScheduLing'])->middleware('auth')->name('form/shiftscheduling/page');
Route::get('form/shiftlist/page', [LeavesController::class, 'shiftList'])->middleware('auth')->name('form/shiftlist/page');

// ----------------------------- Clients ------------------------------//
Route::get('clients/clients', [ClientsController::class, 'clients'])->middleware('auth')->name('clients/clients');
Route::post('clients/new', [ClientsController::class, 'saveRecordClient'])->middleware('auth')->name('clients/new');
Route::post('clients/delete', [ClientsController::class, 'deleteClient'])->middleware('auth')->name('clients/delete');
Route::post('clients/edit', [ClientsController::class, 'editClient'])->middleware('auth')->name('clients/edit');
Route::get('clients/client-profile/{client_id}', [ClientsController::class, 'clientProfile'])->middleware('auth')->name('clients/client-profile');
Route::get('clients/clients-list', [ClientsController::class, 'clientsList'])->middleware('auth')->name('clients/clients-list');

// ----------------------------- Locations ------------------------------//
Route::get('location/locations', [LocationController::class, 'location'])->middleware('auth')->name('location/locations');
Route::post('/location/new', [LocationController::class, 'storeLocation'])->middleware('auth')->name('location/new');
Route::get('location/locations/profile/{id}', [LocationController::class, 'locationProfile'])->middleware('auth')->name('location/locations/profile');
Route::post('location/edit', [LocationController::class, 'locationEdit'])->middleware('auth')->name('location/edit');
Route::post('location/delete', [LocationController::class, 'locationDelete'])->middleware('auth')->name('location/delete');
Route::get('location/locations/list', [LocationController::class, 'locationList'])->middleware('auth')->name('location/locations/list');
// ----------------------------- Locations Dapartament------------------------------//
Route::post('location/type/add', [LocationTypeWorkController::class, 'create'])->middleware('auth')->name('location/type/add');
Route::post('location/type/edit', [LocationTypeWorkController::class, 'edit'])->middleware('auth')->name('location/type/edit');
Route::post('location/type/delete', [LocationTypeWorkController::class, 'delete'])->middleware('auth')->name('location/type/delete');
// ----------------------------- Find Possible Employees------------------------------//
Route::get('location/profile/find/{id}', [FindEmployees::class, 'find'])->middleware('auth')->name('location/profile/find');
Route::post('location/profile/assignment/{id}', [FindEmployees::class, 'assignment'])->middleware('auth')->name('location/profile/assignment');

// ----------------------------- form payroll  ------------------------------//
Route::get('form/salary/page', [PayrollController::class, 'salary'])->middleware('auth')->name('form/salary/page');
Route::get('form/salary/paymentMethod', [PaymentMethodController::class, 'index'])->middleware('auth')->name('form/salary/paymentMethod');
Route::post('form/salary/fulltime', [PaymentMethodController::class, 'FulltimeConfig'])->middleware('auth')->name('form/salary/fulltime');
Route::post('form/salary/parttime', [PaymentMethodController::class, 'ParttimeConfig'])->middleware('auth')->name('form/salary/parttime');
Route::post('form/salary/hourly', [PaymentMethodController::class, 'HourlyConfig'])->middleware('auth')->name('form/salary/hourly');
Route::post('form/salary/save', [PayrollController::class, 'saveRecord'])->middleware('auth')->name('form/salary/save');
Route::post('form/salary/update', [PayrollController::class, 'updateRecord'])->middleware('auth')->name('form/salary/update');
Route::post('form/salary/delete', [PayrollController::class, 'deleteRecord'])->middleware('auth')->name('form/salary/delete');
Route::get('form/salary/view/{rec_id}', [PayrollController::class, 'salaryView'])->middleware('auth');
Route::get('form/payroll/items', [PayrollController::class, 'payrollItems'])->middleware('auth')->name('form/payroll/items');
Route::get('form/payroll/items/pdf/{rec_id}', [PayrollController::class, 'createPDF'])->middleware('auth')->name('form/payroll/items/pdf');
Route::post('form/salary/edit/{rec_id}', [UserController::class, 'editsalary'])->middleware('auth')->name('form/salary/edit');


// ----------------------------- reports  ------------------------------//
Route::get('form/expense/reports/page', [ExpenseReportsController::class, 'index'])->middleware('auth')->name('form/expense/reports/page');
Route::get('form/invoice/reports/page', [ExpenseReportsController::class, 'invoiceReports'])->middleware('auth')->name('form/invoice/reports/page');
Route::get('form/invoice/view/page', [ExpenseReportsController::class, 'invoiceView'])->middleware('auth')->name('form/invoice/view/page');
Route::get('form/daily/reports/page', [ExpenseReportsController::class, 'dailyReport'])->middleware('auth')->name('form/daily/reports/page');
Route::get('form/leave/reports/page', [ExpenseReportsController::class, 'leaveReport'])->middleware('auth')->name('form/leave/reports/page');

// ----------------------------- incidents  ------------------------------//
Route::get('form/incident/reports', [IncidentReportController::class, 'indexAdmin'])->middleware('auth')->name('form/incident/reports');
Route::get('form/incident/reports/page', [IncidentReportController::class, 'index'])->middleware('auth')->name('form/incident/reports/page');
Route::post('form/incident/reports/new', [IncidentReportController::class, 'createReport'])->middleware('auth')->name('form/incident/reports/new');
Route::get('form/incident/report/show/{id}', [IncidentReportController::class, 'showReport'])->middleware('auth')->name('form/incident/report/show/{id}');

// ----------------------------- performance  ------------------------------//
Route::get('form/performance/indicator/page', [PerformanceController::class, 'index'])->middleware('auth')->name('form/performance/indicator/page');
Route::get('form/performance/page', [PerformanceController::class, 'performance'])->middleware('auth')->name('form/performance/page');
Route::get('form/performance/appraisal/page', [PerformanceController::class, 'performanceAppraisal'])->middleware('auth')->name('form/performance/appraisal/page');
Route::post('form/performance/indicator/save', [PerformanceController::class, 'saveRecordIndicator'])->middleware('auth')->name('form/performance/indicator/save');
Route::post('form/performance/indicator/delete', [PerformanceController::class, 'deleteIndicator'])->middleware('auth')->name('form/performance/indicator/delete');
Route::post('form/performance/indicator/update', [PerformanceController::class, 'updateIndicator'])->middleware('auth')->name('form/performance/indicator/update');

Route::post('form/performance/appraisal/save', [PerformanceController::class, 'saveRecordAppraisal'])->middleware('auth')->name('form/performance/appraisal/save');
Route::post('form/performance/appraisal/update', [PerformanceController::class, 'updateAppraisal'])->middleware('auth')->name('form/performance/appraisal/update');
Route::post('form/performance/appraisal/delete', [PerformanceController::class, 'deleteAppraisal'])->middleware('auth')->name('form/performance/appraisal/delete');

// ----------------------------- training  ------------------------------//
Route::get('form/training/list/page', [TrainingController::class, 'index'])->middleware('auth')->name('form/training/list/page');
Route::post('form/training/save', [TrainingController::class, 'addNewTraining'])->middleware('auth')->name('form/training/save');
Route::post('form/training/delete', [TrainingController::class, 'deleteTraining'])->middleware('auth')->name('form/training/delete');
Route::post('form/training/update', [TrainingController::class, 'updateTraining'])->middleware('auth')->name('form/training/update');

// ----------------------------- trainers  ------------------------------//
Route::get('form/trainers/list/page', [TrainersController::class, 'index'])->middleware('auth')->name('form/trainers/list/page');
Route::post('form/trainers/save', [TrainersController::class, 'saveRecord'])->middleware('auth')->name('form/trainers/save');
Route::post('form/trainers/update', [TrainersController::class, 'updateRecord'])->middleware('auth')->name('form/trainers/update');
Route::post('form/trainers/delete', [TrainersController::class, 'deleteRecord'])->middleware('auth')->name('form/trainers/delete');

// ----------------------------- Company Settings ------------------------------//
Route::get('company/store', [CompanyInfoController::class, 'CompanyStore'])->middleware('auth')->name('company/store');
Route::post('company/settings', [CompanyInfoController::class, 'CompanySettings'])->middleware('auth')->name('company/settings');

// ----------------------------- Theme Settings ------------------------------//
Route::get('theme/settings', [ThemeSettingsController::class, 'WebsiteStore'])->middleware('auth')->name('theme/settings');
Route::post('theme/store', [ThemeSettingsController::class, 'WebsiteSettings'])->middleware('auth')->name('theme/store');

// ----------------------------- Clock Settings ------------------------------//
Route::get('timeclock/settings', [ClockTimeSettingsController::class, 'index'])->middleware('auth')->name('timeclock/settings');
Route::post('timeclock/update', [ClockTimeSettingsController::class, 'update'])->middleware('auth')->name('timeclock/update');

// ----------------------------- TimeClock/Attendance -----------------------------------//
Route::get('employee/attendance', [TimeClockController::class, 'clock'])->middleware('auth')->name('employee/attendance');
Route::post('attendance/add', [TimeClockController::class, 'add'])->middleware('auth')->name('attendance/add');
Route::post('attendance/search', [TimeClockController::class, 'search'])->middleware('auth')->name('attendance/search');
Route::get('attendance/page', [AdminAttendance::class, 'AdminAttendance'])->middleware('auth')->name('attendance/page');
Route::post('attendance/page/search', [AdminAttendance::class, 'attSearch'])->middleware('auth')->name('attendance/page/search');
Route::post('attendance/page/manual-entrance', [AdminAttendance::class, 'manualEntrance'])->middleware('auth')->name('attendance/page/manual-entrance');
Route::post('attendance/page/edit', [AdminAttendance::class, 'edit'])->middleware('auth')->name('attendance/page/edit');
Route::post('attendance/page/delete', [AdminAttendance::class, 'delete'])->middleware('auth')->name('attendance/page/delete');

// -------------------- Posts --------------------------------------------------------------------------------------------
// ---------------------------------- App--------------------------------------------------------//
// Route::group(['prefix' => 'posts'], function() {
Route::get('posts', [PostsController::class, 'index'])->middleware('auth')->name('posts');
Route::post('posts/create', [PostsController::class, 'create'])->middleware('auth')->name('posts/create');
Route::get('posts/search', [PostsController::class, 'searchPost'])->name('posts/search');
Route::get('posts/show/{post}', [PostsController::class, 'show'])->middleware('auth')->name('posts/show');
Route::post('posts/edit', [PostsController::class, 'edit'])->middleware('auth')->name('posts/edit');
Route::post('posts/delete', [PostsController::class, 'delete'])->middleware('auth')->name('posts/delete');
// });
// Route::get('/show-event-calendar', [EventController::class, 'index']);
// Route::post('/manage-events', [EventController::class, 'manageEvents']);
// Route::get('ckeditor', [EventController::class, 'index']);
// Route::post('fullcalendar/create', [EventController::class, 'create']);
// Route::post('fullcalendar/update', [EventController::class, 'update']);
// Route::post('fullcalendar/delete', [EventController::class, 'destroy']);

Route::get('fullcalender', [EventController::class, 'index'])->middleware('auth');
Route::post('fullcalenderAjax', [EventController::class, 'ajax'])->middleware('auth');

//---------------------------------Notification----------------------------------------------------
Route::get('all/notification', [NotificationsController::class, 'index'])->middleware('auth')->name('all/notification');
Route::get('markall/notification', [NotificationsController::class, 'markAll'])->middleware('auth')->name('markall/notification');
Route::get('show/notification/{id}', [NotificationsController::class, 'show'])->middleware('auth')->name('show/notification');
Route::get('delete/notification/{id}', [NotificationsController::class, 'delete'])->middleware('auth')->name('delete/notification');
Route::get('deleteone/notification/{id}', [NotificationsController::class, 'deleteone'])->middleware('auth')->name('deleteone/notification');
