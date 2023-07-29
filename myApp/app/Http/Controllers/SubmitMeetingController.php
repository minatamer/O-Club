<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\View;

class SubmitMeetingController extends Controller
{
    //
    public function submitMeeting(Request $request){
        //save entries to the team table database
        $username = $request->get('username');
        $datetime = $request->get('datetime');
        $projectSummary = $request->get('projectSummary');

        //view the calendly interface
        return view('calendly');
        
    }

}
