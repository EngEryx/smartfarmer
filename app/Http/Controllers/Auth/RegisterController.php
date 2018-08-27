<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\SendEmailConfirmation;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users|min:10|max:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'location' => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'user_type' => 1,
            'verify_code' => rand(11111,99999),
            'phone' => $data['phone'],
            'email' => $data['email'],
            'confirmed' => 0,
            'location' => $data['location'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(\Illuminate\Http\Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//        $this->guard()->login($user);

        Notification::route('mail', $user->email)
            ->notify(new SendEmailConfirmation($user));

        session()->flash('status',"We've sent you a confirmation email.Follow the link to activate your account.");

        return redirect()->route('landing')->withStatus("We've sent you a confirmation email.Follow the link to activate your account.");

//        return $this->registered($request, $user)
//            ?: redirect($this->redirectPath());
    }

    public function verifyUser(Request $request, $token)
    {
        $user = User::where(['verify_code'=>$token]);

        if(!$user->exists()){

            session()->flash('status',"Invalid Confirmation Code");

            return redirect()->route('landing')->withStatus("Invalid Verification Code");
        }

        $user = $user->first();
        $user->confirmed = 1;
        $user->save();

        session()->flash('status',"Email confirmed successfully!");

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

}
