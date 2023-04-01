<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

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
                'telephone' => 'required|string|min:10|max:10|regex:/^0[0-9]{9}$/',
                'apartment_number' => 'required|string|max:256',
                'street' => 'required|string|max:256',
                'ward' => 'required|string|max:256',
                'district' => 'required|string|max:256',
                'city' => 'required|string|max:256',
                'receive_newsletter' => 'in:1,0',
                'receive_offers' => 'in:1,0',
            ],
            [
                'password.regex' => 'Password must be at least 8 and up to 10 characters, one uppercase letter, one lowercase letter, one number and one special character.',
                'retyped_password.regex' => 'Password must be at least 8 and up to 10 characters, one uppercase letter, one lowercase letter, one number and one special character.',
                'telephone.regex' => 'Telephone must be 10 digits and start with 0.',
            ]
        );
        User::create($request->all());
        return redirect()->route('login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    protected function attemptLogin(Request $request)
    {
        $valid = Auth::attempt($this->credentials($request), $request->filled('remember'));
        if($valid){
            $user = Auth::user();
            if ($user->is_locked) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Your account is locked.',
                ]);
            }
        }
        return $valid;
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }
}
