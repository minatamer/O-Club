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

class UserController extends Controller
{
    //

    public function viewBriefs(Request $request){
        $username = session()->get('username');
        $userid = User::where('username' , $username)->value('user_id');
        return view('user' , ['briefs'=> Brief::where('user_id' , $userid)->get() , 'users' => User::where('user_id' , $userid)->get()]);
    }

    public function changePassword(Request $request){
        $username = session()->get('username');
        $userid = User::where('username' , $username)->value('user_id');
        $user = User::find($userid);
        $user->timestamps = false;
        $user->password = $request->password;
        $user->save();

        $account = System_Accounts::where('username' , $username)->first();
        $account->password = $request->password;
        $account->timestamps = false;
        $account->save();
        return redirect('http://127.0.0.1:8000/user/');
    }

    public function changeMobile(Request $request){
        $username = session()->get('username');
        $userid = User::where('username' , $username)->value('user_id');
        $user = User::find($userid);
        $user->timestamps = false;
        $user->mobile = $request->mobile;
        $user->save();
        return redirect('http://127.0.0.1:8000/user/');
    }

    public function viewBenefits(Request $request){
        $username = session()->get('username');
        $userid = User::where('username' , $username)->value('user_id');
        return view('user.benefits' , ['benefits'=> Benefit::where('user_id' , $userid)->get()]);

    }

    public function redeemBenefit(Request $request){
        $username = session()->get('username');
        $userid = User::where('username' , $username)->value('user_id');
        $benefit = Benefit::where('user_id' , $userid)->where('benefit_id' , $request->benefit)->first();
        $benefit->timestamps = false;
        $benefit->redeemed = 1;
        $benefit->save();
        return redirect('http://127.0.0.1:8000/user/benefits');
    }

    public function viewProjects(Request $request){
        return view('user.projectsandservices' , ['projects'=> Projects_and_Services::all()]);
    }

    public function viewProjects2(Request $request){
        return view('user.bookameeting' , ['projects'=> Projects_and_Services::all()]);
    }

    public function reportProblem (Request $request){
        $username = session()->get('username');
        $userid = User::where('username' , $username)->value('user_id');

        $problem = new Problem;
        $problem->name = $request->problemTitle;
        $problem->description = $request->problemDescription;
        $problem->user_id = $userid;
        $problem->timestamps = false;
        $problem->save();
        return redirect('http://127.0.0.1:8000/user');

    }

    public function giveFeedback(Request $request){
        $username = session()->get('username');
        $userid = User::where('username' , $username)->value('user_id');

        $feedback = new Feedback;
        $feedback->name = $request->feedbackTitle;
        $feedback->description = $request->feedbackDescription;
        $feedback->user_id = $userid;
        $feedback->timestamps = false;
        $feedback->save();
        return redirect('http://127.0.0.1:8000/user');
    }

    public function viewHistory(Request $request){
        $username = session()->get('username');
        $query1 = Financial_History::where('sender' , $username)->get();
        $query2 =Financial_History::where('receiver' , $username)->get();
        $union = $query1->merge($query2);
        return view('user.financialhistory' , ['histories'=>  $union ]);
    }

    public function viewTransactions(Request $request){
        $username = session()->get('username');
        $query1 = Money_Transaction::where('sender' , $username)->get();
        return view('user.moneytransaction' , ['transactions'=>  $query1 ]);
    }

    public function doTransaction (Request $request){
        $username = session()->get('username');
        
        $history = new Financial_History;
        $history->date = date('Y-m-d');
        $history->amount = $request->amountToSend;
        $history->sender = $username;
        $history->receiver = $request->receiverUsername;
        $history->timestamps = false;
        if (System_Accounts::where('username' , $request->receiverUsername)->exists()){
            $history->save();
        }
        else {
            $request->session()->flash('error','Receiver username does not exist.' );
            return redirect('http://127.0.0.1:8000/user/moneytransaction');
        }

        $transaction = new Money_Transaction;
        $transaction->date = date('Y-m-d');
        $transaction->amount = $request->amountToSend;
        $transaction->sender = $username;
        $transaction->receiver = $request->receiverUsername;
        $transaction->timestamps = false;
        if (System_Accounts::where('username' , $request->receiverUsername)->exists()){
            $transaction->save();
        }
        

        return redirect('http://127.0.0.1:8000/user/moneytransaction');
    }

    public function submitMeeting(Request $request){
        //save entries to the team table database
        $username = session()->get('username');
        $datetime = $request->get('datetime');
        $projectSummary = $request->get('projectSummary');
        $userid = User::where('username' , $username)->value('user_id');

        $newbrief = new Brief;
        $newbrief->user_id = $userid;
        $newbrief->description = $projectSummary;
        $newbrief->date = $request->datetime;
        $newbrief->project = $request->project;
        $newbrief->timestamps = false;
        $newbrief->save();

        $calendar = new Team_Calendar;
        $calendar-> name = $username;
        $calendar->email = User::where('username' , $username)->value('email');
        $calendar->date =  $request->datetime;
        $calendar->summary = $request->get('projectSummary');
        $calendar->timestamps = false;
        $calendar->save();

        //view the calendly interface
        return view('user.calendly');
        
    }

    public function cancelSlot(Request $request){
        $username = session()->get('username');
        $userid = User::where('username' , $username)->value('user_id');
        $date = Brief::where('user_id' , $userid)->where('brief_id' , $request->slot)->value('date');
        Brief::where('user_id' , $userid)->where('brief_id' , $request->slot)->delete();
        Team_Calendar::where('name', $username)->where('date' , $date)->delete();
        return redirect('http://127.0.0.1:8000/user/');

    }

    public function editSlot (Request $request){
        $username = session()->get('username');
        $userid = User::where('username' , $username)->value('user_id');
        $date = Brief::where('user_id' , $userid)->where('brief_id' , $request->slotID)->value('date');

        $editBrief = Brief::where('user_id' , $userid)->where('brief_id' , $request->slotID)->first();
        $editBrief->description = $request->newDescription;
        $editBrief->timestamps = false;
        $editBrief->save();

        $editCalendar = Team_Calendar::where('name', $username)->where('date' , $date)->first();
        $editCalendar->summary =  $request->newDescription;
        $editCalendar->timestamps = false;
        $editCalendar->save();
        return redirect('http://127.0.0.1:8000/user/');
    }
}
