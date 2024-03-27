<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class HomeController extends Controller
{
    public function index()
    {
         
            if(Auth::check()){
               $is_active = "";
                $startOfWeek = now()->startOfWeek();
                $endOfWeek = now()->endOfWeek();
                $today = today()->toDateString();
                $projectCount = DB::table('weekly_reports')
                                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                    ->count();
                $active_projects = Projects::where('timeline', '>', $today)->count();                                       
                $tot_user = User::count();
                $tot_act_user =   User::where('status',1)->where('type','developer')->count();    
                return view('home',compact('tot_user','tot_act_user','projectCount','active_projects','is_active'));
            }
            else{
                return view('auth.login');           
            }       
        
    }
    public function login(Request $request)
    {
        try {
                $credentials = $request->only('email','password');
                $credentials['status'] = 1;
                if (Auth::attempt($credentials)) {
                    session()->put('type', Auth::user()->type);
                    session()->put('user_name', Auth::user()->name);
                    session()->put('user_mail', Auth::user()->email);
                    session()->put('user_id', Auth::user()->id);
                    return redirect()->route('login');
                }
                return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
            }
        catch (\Throwable $th){
            $message="Invalid Credentials or Account.";
            return redirect()->back()->withErrors($message);
        }
    }

    public function logout(){
        session()->flush();
        \Cookie::forget('laravel_session');
        Auth::logout();
        return redirect()->route('login');

    }
}
