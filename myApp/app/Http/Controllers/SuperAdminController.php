<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brief;
use App\Models\User;
use App\Models\Benefit;
use App\Models\Projects_and_Services;
use App\Models\Problem;
use App\Models\Feedback;
use App\Models\Financial_History;
use App\Models\Money_Transaction;
use App\Models\System_Accounts;
use App\Models\Team_Calendar;
use App\Models\Admin;
use App\Models\Super_Admin;
use App\Models\Account_Manager;

class SuperAdminController extends Controller
{
    public function viewSlots(Request $request){
        return view('superadmin' , ['slots'=> Brief::where('status' , 'Approved')->get()]);
    }

    public function viewUsers(Request $request){
        return view('superadmin/manageusers' , ['users'=> User::all()]);
    }

    public function viewUserData(Request $request){
        $username = User::where('user_id',$request->userID)->value('username'); 
        $userID = $request->userID;
      
        return view('superadmin/userdata' , ['users'=> User::where('user_id' , $userID)->get() , 
        'briefs'=> Brief::where('user_id' , $userID)->get() , 'benefits'=> Benefit::where('user_id' , $userID)->get() , 
        'feedbacks' => Feedback::where('user_id' , $userID)->get() , 'problems' => Problem::where('user_id' , $userID)->get() ,
        'senders'=>Financial_History::where('sender',$username)->get(),'receivers'=>Financial_History::where('receiver',$username)->get() ]);
    }

    public function deleteUser(Request $request){
        //TO DELETE A USER YOU NEED TO DELETE: their benefits, briefs, feedback, problem, FINANCIAL HISTORY AND MONEY TRANSACTION
        // THEN YOU NEED TO DELETE THE USER ITSELF AND THEN YOU CAN DELETE THE SYSTEM ACCOUNT
        
        $username = User::where('user_id',$request->userID)->value('username');        
        //DELETE BENEFIT
        try {
            Benefit::where('user_id',$request->userID)->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }

        //DELETE Briefs
        try {
            Brief::where('user_id',$request->userID)->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }

        //DELETE FEEDBACK
        try {
            Feedback::where('user_id',$request->userID)->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }

        //DELETE PROBELM
        try {
            Problem::where('user_id',$request->userID)->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        

        //DELETE USER
        try {
            User::where('user_id',$request->userID)->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }

        //DELETE THEIR FINANCIAL HISTORU
        try {
            if ( Financial_History::where('sender',$username)->exists()){
                Financial_History::where('sender',$username)->delete();
            }
            if ( Financial_History::where('receiver',$username)->exists()){
                Financial_History::where('receiver',$username)->delete();
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }

        //DELETE THEIR MONEY TRANSACTIONS
        try {
            if ( Money_Transaction::where('sender',$username)->exists()){
                Money_Transaction::where('sender',$username)->delete();
            }
            if ( Money_Transaction::where('receiver',$username)->exists()){
                Money_Transaction::where('receiver',$username)->delete();
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }

        //DELETE SYSTEM ACCOUNT
        try {
            System_Accounts::where('username',$username)->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        return view('superadmin/manageusers' , ['users'=> User::all()]);
    }

    public function assignManager(Request $request){
        $user = User::where('user_id' , $request->userID)->first();
        $user->manager = $request->email;
        $user->timestamps =false;
        $user->save();
        return view('superadmin/manageusers' , ['users'=> User::all()]);
    }

    public function viewAdmins(Request $request){
        return view('superadmin/manageadmins' , ['admins'=> Admin::all()]);
    }

    public function deleteAdmin (Request $request){
        $username = Admin::where('admin_id' , $request->adminID)->value('username');
        Admin::where('admin_id' , $request->adminID)->delete();
        System_Accounts::where('username' , $username)->delete();
        return view('superadmin/manageadmins' , ['admins'=> Admin::all()]);
    }

    public function addAdmin (Request $request){
        $account = new System_Accounts;
        $account->username = $request->username;
        $account->password = $request->password;
        $account->email = $request->email;
        $account->mobile = $request->mobile;
        $account->type = 'Admin';
        $account->timestamps = false;
        $account->save();
        
        
        $admin = new Admin;
        $admin->username = $request->username;
        $admin->password = $request->password;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->timestamps = false;
        $admin->save();
        return view('superadmin/manageadmins' , ['admins'=> Admin::all()]);
    }

    public function editAdmin (Request $request){
        $username = Admin::where('admin_id' , $request->adminID)->value('username');

        $account =  System_Accounts::where('username' , $username)->first();
        $account->email = $request->email;
        $account->mobile = $request->mobile;
        $account->timestamps = false;
        $account->save();


        $admin = Admin::where('username' , $username)->first();
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->timestamps = false;
        $admin->save();
        
        return view('superadmin/manageadmins' , ['admins'=> Admin::all()]);
    }

    public function viewProjects(Request $request){
        return view('superadmin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);

    }

    public function deleteProject (Request $request){
        Projects_and_Services::where('prod_id' , $request->projID)->delete();
        return view('superadmin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function addProject (Request $request){
        $project = new Projects_and_Services;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->timestamps = false;
        $project->save();
        return view('superadmin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function editProject (Request $request){
        $project = Projects_and_Services::where('prod_id' , $request->projID)->first();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->timestamps = false;
        $project->save();
        
        return view('superadmin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function viewBriefs(Request $request){
        return view('superadmin/managebriefs' , ['briefs'=> Brief::all()]);
    }

    public function approveBrief(Request $request){
        $brief = Brief::where('brief_id' , $request->briefID)->first();
        $brief->status = 'Approved';
        $brief->timestamps = false;
        $brief->save();
        return view('superadmin/managebriefs' , ['briefs'=> Brief::all()]);


    }

    public function denyBrief(Request $request){
        $brief = Brief::where('brief_id' , $request->briefID)->first();
        $brief->status = 'Denied';
        $brief->timestamps = false;
        $brief->save();
        return view('superadmin/managebriefs' , ['briefs'=> Brief::all()]);

    }

    public function viewManagers(Request $request){
        return view('superadmin/manageaccountmanagers' , ['managers'=> Account_Manager::all()]);
    }

    public function addManager(Request $request){
        $manager = new Account_Manager;
        $manager->email = $request->email;
        $manager->name = $request->name;
        $manager->timestamps = false;
        $manager->save();
        return view('superadmin/manageaccountmanagers' , ['managers'=> Account_Manager::all()]);


    }

    public function deleteManager(Request $request){
        //REMOVE THEM FROM BEING ASSIGNED TO ANY USER FIRST
        $users = User::where('manager' , $request->email)->get();
        foreach ($users as $user) {
            $user->manager = null;
            $user->timestamps=false;
            $user->save();
        }
        Account_Manager::where('email' , $request->email)->delete();
        return view('superadmin/manageaccountmanagers' , ['managers'=> Account_Manager::all()]);

    }

    public function viewFeedback(Request $request){
        return view('superadmin/viewfeedback' , ['feedbacks'=> Feedback::all()]);
    }

    public function viewProblems(Request $request){
        return view('superadmin/viewproblems' , ['problems'=> Problem::all()]);
    }

    



}
