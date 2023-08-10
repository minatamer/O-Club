<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitMeetingController;
use App\Http\Controllers\DBController;
use App\Http\Controllers\SystemAccountsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('home');
});

Route::get('/guest', function () {
    return view('guest');
});

Route::get('/forgotpassword', function () {
    return view('forgotpassword');
});

Route::post('/saveUserAccount', [SystemAccountsController::class, 'saveUserAccount'])-> name('saveUserAccount');

Route::post('/login', [SystemAccountsController::class, 'login'])-> name('login');

Route::post('/getTempPassword', [SystemAccountsController::class, 'getTempPassword'])-> name('getTempPassword');

Route::get('/signOut', [SystemAccountsController::class, 'signOut'])-> name('signOut');


Route::get('/user/bookameeting', [UserController::class, 'viewProjects2'])-> name('viewProjects2');

Route::get('/user', [UserController::class, 'viewBriefs'])-> name('user');

Route::get('/user/projectsandservices', [UserController::class, 'viewProjects'])-> name('viewProjects');

Route::get('/user/moneytransaction', [UserController::class, 'viewTransactions'])-> name('viewTransactions');

Route::get('/user/financialhistory', [UserController::class, 'viewHistory'])-> name('viewHistory');

Route::get('/user/problem', function () {
    return view('user.problem');
});

Route::get('/user/feedback', function () {
    return view('user.feedback');
});


Route::get('/user/benefits', [UserController::class, 'viewBenefits'])-> name('viewBenefits');

Route::post('/submitMeeting', [UserController::class, 'submitMeeting'])-> name('submitMeeting');

Route::post('/changePassword', [UserController::class, 'changePassword'])-> name('changePassword');

Route::post('/changeMobile', [UserController::class, 'changeMobile'])-> name('changeMobile');

Route::post('/redeemBenefit', [UserController::class, 'redeemBenefit'])-> name('redeemBenefit');

Route::post('/reportProblem', [UserController::class, 'reportProblem'])-> name('reportProblem');

Route::post('/giveFeedback', [UserController::class, 'giveFeedback'])-> name('giveFeedback');

Route::post('/doTransaction', [UserController::class, 'doTransaction'])-> name('doTransaction');

Route::post('/cancelSlot', [UserController::class, 'cancelSlot'])-> name('cancelSlot');

Route::post('/editSlot', [UserController::class, 'editSlot'])-> name('editSlot');



Route::get('/superadmin/manageusers', [SuperAdminController::class, 'viewUsersandManagers'])-> name('viewUsersandManagers');

Route::get('/superadmin', [SuperAdminController::class, 'viewSlots'])-> name('viewSlots');

Route::get('/superadmin/manageadmins', [SuperAdminController::class, 'viewAdminsandSuperAdmins'])-> name('viewAdminsandSuperAdmins');

Route::get('/superadmin/manageprojectsandservices', [SuperAdminController::class, 'viewProjects'])-> name('viewProjects');

Route::get('/superadmin/managebriefs', [SuperAdminController::class, 'viewBriefs'])-> name('viewBriefs');

Route::get('/superadmin/manageaccountmanagers', [SuperAdminController::class, 'viewManagers'])-> name('viewManagers');

Route::get('/superadmin/viewfeedback', [SuperAdminController::class, 'viewFeedback'])-> name('viewFeedback');

Route::get('/superadmin/viewproblems', [SuperAdminController::class, 'viewProblems'])-> name('viewProblems');

Route::post('/viewUserData', [SuperAdminController::class, 'viewUserData'])-> name('viewUserData');

Route::post('/addUser', [SuperAdminController::class, 'addUser'])-> name('addUser');

Route::post('/deleteUser', [SuperAdminController::class, 'deleteUser'])-> name('deleteUser');

Route::post('/assignManager', [SuperAdminController::class, 'assignManager'])-> name('assignManager');

Route::post('/deleteAdmin', [SuperAdminController::class, 'deleteAdmin'])-> name('deleteAdmin');

Route::post('/addAdmin', [SuperAdminController::class, 'addAdmin'])-> name('addAdmin');

Route::post('/editAdmin', [SuperAdminController::class, 'editAdmin'])-> name('editAdmin');

Route::post('/deleteSuperAdmin', [SuperAdminController::class, 'deleteSuperAdmin'])-> name('deleteSuperAdmin');

Route::post('/addSuperAdmin', [SuperAdminController::class, 'addSuperAdmin'])-> name('addSuperAdmin');

Route::post('/editSuperAdmin', [SuperAdminController::class, 'editSuperAdmin'])-> name('editSuperAdmin');

Route::post('/approveBrief', [SuperAdminController::class, 'approveBrief'])-> name('approveBrief');

Route::post('/denyBrief', [SuperAdminController::class, 'denyBrief'])-> name('denyBrief');

Route::post('/addManager', [SuperAdminController::class, 'addManager'])-> name('addManager');

Route::post('/deleteManager', [SuperAdminController::class, 'deleteManager'])-> name('deleteManager');

Route::post('/deleteProject', [SuperAdminController::class, 'deleteProject'])-> name('deleteProject');

Route::post('/addProject', [SuperAdminController::class, 'addProject'])-> name('addProject');

Route::post('/editProject', [SuperAdminController::class, 'editProject'])-> name('editProject');



Route::get('/admin', [AdminController::class, 'viewSlots'])-> name('viewSlots');

Route::get('/admin/manageusers', [AdminController::class, 'viewUsersandManagers'])-> name('viewUsersandManagers');

Route::get('/admin/manageprojectsandservices', [AdminController::class, 'viewProjects'])-> name('viewProjects');

Route::get('/admin/managebriefs', [AdminController::class, 'viewBriefs'])-> name('viewBriefs');

Route::get('/admin/manageaccountmanagers', [AdminController::class, 'viewManagers'])-> name('viewManagers');

Route::get('/admin/viewfeedback', [AdminController::class, 'viewFeedback'])-> name('viewFeedback');

Route::get('/admin/viewproblems', [AdminController::class, 'viewProblems'])-> name('viewProblems');

Route::post('/viewUserData-Admin', [AdminController::class, 'viewUserData'])-> name('viewUserData-Admin');

Route::post('/addUser-Admin', [AdminController::class, 'addUser'])-> name('addUser-Admin');

Route::post('/deleteUser-Admin', [AdminController::class, 'deleteUser'])-> name('deleteUser-Admin');

Route::post('/assignManager-Admin', [AdminController::class, 'assignManager'])-> name('assignManager-Admin');

Route::post('/approveBrief-Admin', [AdminController::class, 'approveBrief'])-> name('approveBrief-Admin');

Route::post('/denyBrief-Admin', [AdminController::class, 'denyBrief'])-> name('denyBrief-Admin');

Route::post('/addManager-Admin', [AdminController::class, 'addManager'])-> name('addManager-Admin');

Route::post('/deleteManager-Admin', [AdminController::class, 'deleteManager'])-> name('deleteManager-Admin');

Route::post('/deleteProject-Admin', [AdminController::class, 'deleteProject'])-> name('deleteProject-Admin');

Route::post('/addProject-Admin', [AdminController::class, 'addProject'])-> name('addProject-Admin');

Route::post('/editProject-Admin', [AdminController::class, 'editProject'])-> name('editProject-Admin');