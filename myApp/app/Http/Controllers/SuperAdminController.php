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
use Illuminate\Support\Facades\Crypt;

class SuperAdminController extends Controller
{
    public function userChecker(Request $request){
        if (session()->get('key') != 'Super Admin'){
            $request->session()->flash('error','Cannot access this page' );
            return false;
        }
        else{
            return true;
        }

    }

    public function viewSlots(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        return view('superadmin' , ['slots'=> Brief::where('status' , 'Approved')->get()]);
    }

    public function viewUsersandManagers(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        return view('superadmin/manageusers' , ['users'=> User::all() , 'managers' => Account_Manager::all()]);
    }

    public function viewUserData(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $username = User::where('user_id',$request->userID)->value('username'); 
        $userID = $request->userID;
      
        return view('superadmin/userdata' , ['users'=> User::where('user_id' , $userID)->get() , 
        'briefs'=> Brief::where('user_id' , $userID)->get() , 'benefits'=> Benefit::where('user_id' , $userID)->get() , 
        'feedbacks' => Feedback::where('user_id' , $userID)->get() , 'problems' => Problem::where('user_id' , $userID)->get() ,
        'senders'=>Financial_History::where('sender',$username)->get(),'receivers'=>Financial_History::where('receiver',$username)->get() ]);
    }

    public function addUser(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $newAccount = new System_Accounts;
        $newUser = new User;


        $newAccount->username = $request->username;
        $newAccount->password = Crypt::encrypt($request->password);
        $newAccount->email = Crypt::encrypt($request->email);
        $newAccount->type = 'User';
        $newAccount->timestamps = false;
        $newAccount->save();

        $newUser->username = $request->username;
        $newUser->password = Crypt::encrypt($request->password);
        $newUser->email = Crypt::encrypt($request->email);
        $newUser->timestamps = false;
        $newUser->save();

        $benefit1 = new Benefit;
        $benefit1->name = "Smart Gym Membership";
        $benefit1->description = "Free 2 month Smart Gym Membership in all of their branches";
        $benefit1->redeemed = 0;
        $benefit1->user_id = User::where('username' , $request->username)->value('user_id');
        $benefit1->timestamps = false;
        $benefit1->save();

        $benefit2 = new Benefit;
        $benefit2->name = "Free L'oreal Product";
        $benefit2->description = "Your choice of either face cleanser or moisturizer from L'oreal";
        $benefit2->redeemed = 0;
        $benefit2->user_id = User::where('username' , $request->username)->value('user_id');
        $benefit2->timestamps = false;
        $benefit2->save();

        $benefit3 = new Benefit;
        $benefit3->name = "Free Netflix Subscription";
        $benefit3->description = "Free 2 month Netflix Membership";
        $benefit3->redeemed = 0;
        $benefit3->user_id = User::where('username' , $request->username)->value('user_id');
        $benefit3->timestamps = false;
        $benefit3->save();


        return view('superadmin/manageusers' , ['users'=> User::all() , 'managers' => Account_Manager::all()]);
    }



    public function deleteUser(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
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
        
        return view('superadmin/manageusers' , ['users'=> User::all() , 'managers' => Account_Manager::all()]);
    }

    public function assignManager(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $user = User::where('user_id' , $request->userID)->first();
        $user->manager = $request->email;
        $user->timestamps =false;
        $user->save();
        return view('superadmin/manageusers' , ['users'=> User::all() , 'managers' => Account_Manager::all()]);
    }

    public function viewAdminsandSuperAdmins(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        return view('superadmin/manageadmins' , ['admins'=> Admin::all() , 'superadmins'=>Super_Admin::all()]);
    }

    public function deleteAdmin (Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $username = Admin::where('admin_id' , $request->adminID)->value('username');
        if ($username != 'admin'){
            Admin::where('admin_id' , $request->adminID)->delete();
            System_Accounts::where('username' , $username)->delete();
        }
        else {
            $request->session()->flash('error','Can not delete a staple admin account' );
        }
        
        return view('superadmin/manageadmins' , ['admins'=> Admin::all() , 'superadmins'=>Super_Admin::all()]);
    }

    public function addAdmin (Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $account = new System_Accounts;
        $account->username = $request->username;
        $account->password = Crypt::encrypt($request->password);
        $account->email = Crypt::encrypt($request->email);
        $account->mobile = $request->mobile;
        $account->type = 'Admin';
        $account->timestamps = false;
        $account->save();
        
        
        $admin = new Admin;
        $admin->username = $request->username;
        $admin->password = Crypt::encrypt($request->password);
        $admin->email = Crypt::encrypt($request->email);
        $admin->mobile = $request->mobile;
        $admin->timestamps = false;
        $admin->save();
        return view('superadmin/manageadmins' , ['admins'=> Admin::all() , 'superadmins'=>Super_Admin::all()]);
    }

    public function editAdmin (Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $username = Admin::where('admin_id' , $request->adminID)->value('username');

        $account =  System_Accounts::where('username' , $username)->first();
        $account->email = Crypt::encrypt($request->email);
        $account->mobile = $request->mobile;
        $account->timestamps = false;
        $account->save();


        $admin = Admin::where('username' , $username)->first();
        $admin->email = Crypt::encrypt($request->email);
        $admin->mobile = $request->mobile;
        $admin->timestamps = false;
        $admin->save();
        
        return view('superadmin/manageadmins' , ['admins'=> Admin::all() , 'superadmins'=>Super_Admin::all()]);
    }

    public function deleteSuperAdmin (Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $username = Super_Admin::where('superadmin_id' , $request->superadminID)->value('username');
        if ($username != 'superadmin'){
            Super_Admin::where('superadmin_id' , $request->superadminID)->delete();
            System_Accounts::where('username' , $username)->delete();
        }
        else{
            $request->session()->flash('error','Can not delete a staple super admin account' );
        }
        
        return view('superadmin/manageadmins' , ['admins'=> Admin::all() , 'superadmins'=>Super_Admin::all()]);
    }

    public function addSuperAdmin (Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $account = new System_Accounts;
        $account->username = $request->username;
        $account->password = Crypt::encrypt($request->password);
        $account->email = Crypt::encrypt($request->email);
        $account->mobile = $request->mobile;
        $account->type = 'Super Admin';
        $account->timestamps = false;
        $account->save();
        
        
        $superadmin = new Super_Admin;
        $superadmin->username = $request->username;
        $superadmin->password = Crypt::encrypt($request->password);
        $superadmin->email = Crypt::encrypt($request->email);
        $superadmin->mobile = $request->mobile;
        $superadmin->timestamps = false;
        $superadmin->save();
        return view('superadmin/manageadmins' , ['admins'=> Admin::all() , 'superadmins'=>Super_Admin::all()]);
    }

    public function editSuperAdmin (Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $username = Super_Admin::where('superadmin_id' , $request->superadminID)->value('username');

        $account =  System_Accounts::where('username' , $username)->first();
        $account->email = Crypt::encrypt($request->email);
        $account->mobile = $request->mobile;
        $account->timestamps = false;
        $account->save();


        $superadmin = Super_Admin::where('username' , $username)->first();
        $superadmin->email = Crypt::encrypt($request->email);
        $superadmin->mobile = $request->mobile;
        $superadmin->timestamps = false;
        $superadmin->save();
        
        return view('superadmin/manageadmins' , ['admins'=> Admin::all() , 'superadmins'=>Super_Admin::all()]);
    }






    public function viewProjects(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        return view('superadmin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);

    }

    public function deleteProject (Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        Projects_and_Services::where('prod_id' , $request->projID)->delete();
        return view('superadmin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function addProject (Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $project = new Projects_and_Services;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->timestamps = false;
        $project->save();
        return view('superadmin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function editProject (Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $project = Projects_and_Services::where('prod_id' , $request->projID)->first();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->timestamps = false;
        $project->save();
        
        return view('superadmin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function viewBriefs(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        return view('superadmin/managebriefs' , ['briefs'=> Brief::all()]);
    }

    public function approveBrief(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $brief = Brief::where('brief_id' , $request->briefID)->first();
        $brief->status = 'Approved';
        $brief->timestamps = false;
        $brief->save();
        return view('superadmin/managebriefs' , ['briefs'=> Brief::all()]);


    }

    public function denyBrief(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $brief = Brief::where('brief_id' , $request->briefID)->first();
        $brief->status = 'Denied';
        $brief->timestamps = false;
        $brief->save();
        return view('superadmin/managebriefs' , ['briefs'=> Brief::all()]);

    }

    public function viewManagers(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        return view('superadmin/manageaccountmanagers' , ['managers'=> Account_Manager::all()]);
    }

    public function addManager(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        $manager = new Account_Manager;
        $manager->email = $request->email;
        $manager->name = $request->name;
        $manager->timestamps = false;
        $manager->save();
        return view('superadmin/manageaccountmanagers' , ['managers'=> Account_Manager::all()]);


    }

    public function deleteManager(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
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
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        return view('superadmin/viewfeedback' , ['feedbacks'=> Feedback::all()]);
    }

    public function viewProblems(Request $request){
        if ($this->userChecker($request) == false ){
            return view('home');
        }
        return view('superadmin/viewproblems' , ['problems'=> Problem::all()]);
    }

    



}
