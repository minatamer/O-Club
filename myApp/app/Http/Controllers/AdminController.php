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

class AdminController extends Controller
{
    public function viewSlots(Request $request){
        return view('admin' , ['slots'=> Brief::where('status' , 'Approved')->get()]);
    }

    public function viewUsers(Request $request){
        return view('admin/manageusers' , ['users'=> User::all()]);
    }

    public function viewUserData(Request $request){
        $username = User::where('user_id',$request->userID)->value('username'); 
        $userID = $request->userID;
      
        return view('admin/userdata' , ['users'=> User::where('user_id' , $userID)->get() , 
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
        
        return view('admin/manageusers' , ['users'=> User::all()]);
    }

    public function assignManager(Request $request){
        $user = User::where('user_id' , $request->userID)->first();
        $user->manager = $request->email;
        $user->timestamps =false;
        $user->save();
        return view('admin/manageusers' , ['users'=> User::all()]);
    }

    public function viewProjects(Request $request){
        return view('admin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);

    }

    public function deleteProject (Request $request){
        Projects_and_Services::where('prod_id' , $request->projID)->delete();
        return view('admin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function addProject (Request $request){
        $project = new Projects_and_Services;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->timestamps = false;
        $project->save();
        return view('admin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function editProject (Request $request){
        $project = Projects_and_Services::where('prod_id' , $request->projID)->first();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->timestamps = false;
        $project->save();
        
        return view('admin/manageprojectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function viewBriefs(Request $request){
        return view('admin/managebriefs' , ['briefs'=> Brief::all()]);
    }

    public function approveBrief(Request $request){
        $brief = Brief::where('brief_id' , $request->briefID)->first();
        $brief->status = 'Approved';
        $brief->timestamps = false;
        $brief->save();
        return view('admin/managebriefs' , ['briefs'=> Brief::all()]);


    }

    public function denyBrief(Request $request){
        $brief = Brief::where('brief_id' , $request->briefID)->first();
        $brief->status = 'Denied';
        $brief->timestamps = false;
        $brief->save();
        return view('admin/managebriefs' , ['briefs'=> Brief::all()]);

    }

    public function viewManagers(Request $request){
        return view('admin/manageaccountmanagers' , ['managers'=> Account_Manager::all()]);
    }

    public function addManager(Request $request){
        $manager = new Account_Manager;
        $manager->email = $request->email;
        $manager->name = $request->name;
        $manager->timestamps = false;
        $manager->save();
        return view('admin/manageaccountmanagers' , ['managers'=> Account_Manager::all()]);


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
        return view('admin/manageaccountmanagers' , ['managers'=> Account_Manager::all()]);

    }

    public function viewFeedback(Request $request){
        return view('admin/viewfeedback' , ['feedbacks'=> Feedback::all()]);
    }

    public function viewProblems(Request $request){
        return view('admin/viewproblems' , ['problems'=> Problem::all()]);
    }
}
