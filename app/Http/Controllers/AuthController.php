<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Mail;
use App\Mail\SendMailForgotPassword;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate(
            [
                'first_name' => 'required|string|max:256',
                'last_name' => 'required|string|max:256',
                'email' => 'required|string|email|max:256|unique:users',
                'password' => 'required|string|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,10}$/',
                'retype_password' => 'required|string|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,10}$/|same:password',
                'telephone' => 'required|string|min:10|max:10|unique:users|regex:/^0[0-9]{9}$/',
                'apartment_number' => 'required|string|max:256',
                'street' => 'required|string|max:256',
                'ward' => 'required|string|max:256',
                'district' => 'required|string|max:256',
                'city' => 'required|string|max:256',
                'receive_newsletter' => 'in:on,off',
                'receive_offers' => 'in:on,off',
            ],
            [
                'password.regex' => 'Password must be at least 8 and up to 10 characters, one uppercase letter, one lowercase letter, one number and one special character.',
                'retyped_password.regex' => 'Password must be at least 8 and up to 10 characters, one uppercase letter, one lowercase letter, one number and one special character.',
                'telephone.regex' => 'Telephone must be 10 digits and start with 0.',
            ]
        );
        $request->merge([
            'password' => bcrypt($request->password),
            'receive_newsletter' => $request->receive_newsletter == 'on' ? 1 : 0,
            'receive_offers' => $request->receive_offers == 'on' ? 1 : 0,
        ]);
        User::create($request->all());
        return redirect()->route('login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function forgotPassword(Request $request){
        $request->validate(
            [
                'email' => 'required|string|email|max:256|exists:users',
            ],
            [
                'email.exists' => 'Account does not exist.',
            ]
        );
        $user = User::where('email', $request->email)->first();
        if($user->is_locked){
            throw ValidationException::withMessages([
                'email' => 'Account is locked.',
            ]);
        }
        $newPassword = Str::random(8);
        $user->password = bcrypt($newPassword);
        $user->save();
        if (Mail::to($user->email)->send(new SendMailForgotPassword($user->last_name, $newPassword))) {
            return redirect()->back()->with('success', 'New password has been sent to your email.');
        }
        throw ValidationException::withMessages([
            'email' => 'Something error! Can not send new password.',
        ]);
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    protected function attemptLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:256',
            'password' => 'required|string',
            'remember' => 'in:on,off',
        ]);
        $valid = Auth::attempt($this->credentials($request), $request->filled('remember'));
        if($valid){
            $user = Auth::user();
            if ($user->is_locked) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'account' => 'Your account is locked.',
                ]);
            }
            return $valid;
        }
        throw ValidationException::withMessages([
            'account' => 'These credentials do not match our records.',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }
}
