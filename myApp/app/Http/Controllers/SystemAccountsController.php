<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\System_Accounts;
use App\Models\User;
use App\Models\Benefit;
use App\Models\Forgot_Password;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class SystemAccountsController extends Controller
{
    //
    public function saveUserAccount(Request $request){
        $newAccount = new System_Accounts;
        $newUser = new User;

        $password = $request->firstname.'123';

        $newAccount->username = $request->username;
        $newAccount->password = Crypt::encrypt($password);
        $newAccount->email = Crypt::encrypt($request->email);
        $newAccount->type = 'User';
        $newAccount->timestamps = false;
        $newAccount->save();

        $newUser->username = $request->username;
        $newUser->password = Crypt::encrypt($password);
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


        $request->session()->flash('status','Your account is successfully created! Your username is: '.$request->username.
        ' and your password is: '.$password );


        return view('home');

    }

    public function login (Request $request){
        $username = $request->username;
        $password = $request->password;
        $user = System_Accounts::where('username' , $username)->first();
        $usernameDB = System_Accounts::where('username' , $username)->value('username');   
        $passwordDB = System_Accounts::where('username' , $username)->value('password');   


        if ($user && $password == Crypt::decrypt($passwordDB)) {
            $type =  $user->type;
            if($type == 'User'){
                session(['username' => $username]);
                session(['key' => 'User']);
                return redirect('/user');
            }
            else if ($type == 'Admin'){
                session(['username' => $username]);
                session(['key' => 'Admin']);
                return redirect('/admin');
            }
            else{
                session(['username' => $username]);
                session(['key' => 'Super Admin']);
                return redirect('/superadmin');
            }

        } else {
            $request->session()->flash('error','Incorrect username or password' );
            return view('home');

        }
    }

    public function getTempPassword(Request $request){
        $email = $request->email;
        $allAccounts = System_Accounts::all();
        $exists = '';
        $username = '';
        $encyptedEmail ='';
        foreach ($allAccounts as $anAccount){
            $accountEmail = Crypt::decrypt($anAccount->email);
            if ($accountEmail == $request->email){
                $exists =true;
                $username = $anAccount->username;
                $encyptedEmail = $anAccount->email;
                break;

            }
        } 
        if ($exists){
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $tempPassword = '';
            for ($i = 0; $i < 5; $i++) {
                $tempPassword .= $characters[rand(0, strlen($characters) - 1)];
            }
            
            $encyptedPassword = Crypt::encrypt($tempPassword);

            $account = System_Accounts::where('email' , $encyptedEmail)->first();
                $account->password = $encyptedPassword;
                $account->timestamps = false;
                $account->save();
                
                $user = User::where('username' , $username)->first();
                $user->timestamps = false;
                $user->password = $encyptedPassword;
                $user->save();
        
            try {
                Mail::to($email)->send(new ForgotPassword($tempPassword));        
                $request->session()->flash('status','Mail sent!' );
                return redirect('http://127.0.0.1:8000/');
            } catch (Exception $th) {
                $request->session()->flash('error','error in sending Mail' );
                return view('home');
            }

        }

        else{
            $request->session()->flash('error','Mail doesnt exist' );
            return view('home');
        }
        return redirect('http://127.0.0.1:8000/');
        
    }
    
    public function signOut(){
            session(['key' => '']);
            return redirect('http://127.0.0.1:8000/');
        }
}
