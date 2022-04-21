<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Auth\CanResetPassword;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{

        public function showAdminDash(){
            return view('admin.dashboard');

        }
        public function showhome(){
            return view('user.home');

        }

        public function showUserDash()
        {
            return view('user.profile');
        }
        public function singup()
        {
            return view('user.singup');
        }

        public function register(Request $request){

            Validator::validate($request->all(),[
                'name'=>['required','min:3','max:10'],
                'email'=>['required','email','unique:users,email'],
                'password'=>['required','min:5'],
                'confirm_pass'=>['same:password']


            ],[
                'name.required'=>'this field is required',
                'name.min'=>'can not be less than 3 letters',
                'email.unique'=>'there is an email in the table',
                'email.required'=>'this field is required',
                'email.email'=>'incorrect email format',
                'password.required'=>'password is required',
                'password.min'=>'password should not be less than 3',
                'confirm_pass.same'=>'password dont match',


            ]);

            $u=new User();
            $u->name=$request->name;
            $u->password=Hash::make($request->password);
            $u->email=$request->email;


            if($u->save()){
                $u->attachRole('Admin');
                return redirect()->route('login')
                ->with(['success'=>'user created successful']);
            }

            return back()->with(['error'=>'can not create user']);

        }
        public function showLogin(){
            if(Auth::check())//redirect user to dashboard if he change the router to login and he still in dashboard
            return redirect()->route($this->checkRole());
            else
            return view('user.login');

        }
        public function checkRole(){
            if(Auth::user()->hasRole('Admin'))
            return 'adminDash';
                else
                return 'home';

        }

        public function login(Request $request){
            Validator::validate($request->all(),[
                'email'=>['email','required','min:3','max:50'],
                'password'=>['required','min:5']


            ],[
                'email.required'=>'this field is required',
                'email.min'=>'can not be less than 3 letters',
            ]);
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){


                if(Auth::user()->hasRole('Admin'))//if he login and has admin role and he is active=1 redirct him to dashboard route

                return redirect()->route('adminDash');
                else
                return redirect()->route('userDash');



            }
            else {
                return redirect()->route('login')->with(['message'=>'incorerct username or password or your account is not active ']);
            }

            }


            public function logout(){

                Auth::logout();
                return redirect()->route('login');

            }

    }


