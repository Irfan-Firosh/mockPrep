<?php

namespace App\Http\Controllers\register;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class LoginController extends Controller
{
    public function store_login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials, $request->input('remember'))) {
            $request->session()->regenerate();
            $user = User::where('email', $credentials['email']);
            $array = ['user' => $user->name, 'success' => 'Logged In Succesfully'];
            return redirect()->route('user.home')->with('data', $array);
        }
        
        return back()->withErrors([
            'invalid' => 'Your credentials do not match our records'
        ]);
    }

    public function store_register(Request $request) {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:15|unique:users,name',
            'email' => 'email|required|unique:users,email',
            'password' => [
                'required',
                'max:12',
                'min:5',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&~])(?=.*[a-z]).{7,12}$/',
                'required_with:password_confirmation',
                'same:password_confirmation'
            ],
            'password_confirmation' => 'required|max:12|min:7'
        ], [
            'name.required' => 'The username is required',
            "name.min" => "The username should contain atleast 3 characters",
            "name.max" => "The username should not be more than 15 characters",
            'name.unique' => "The name should be unique",
            'password.regex' => 'The password must include at least one uppercase letter, one special character, and one digit.',
            'password_confirmation' => 'Passwords do not match'
        ]);
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);
        Auth::login($user, $request->input('frem'));
        $array = ['user' => $user->name, 'success' => 'Logged In Succesfully'];
        return redirect()->route('user.home')->with('data', $array);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }

    public function gitRedirect() {
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback() {
        $gituser = Socialite::driver('github')->user(); 
        $user = User::updateOrCreate([
            'github_id' => $gituser->id
        ], [
            'name' => $gituser->name,
            'email' => $gituser->email,
            'password' => bcrypt(request(Str::random()))
        ]);

        Auth::login($user, true);
        $array = ['user' => $user->name, 'success' => 'Logged In Succesfully'];
        return redirect()->route('user.home')->with('data', $array);
    }

    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback() {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();
            if(!$user)
            {
                $user = User::create([
                    'name' => $googleUser->name, 
                    'email' => $googleUser->email, 
                    'password' => bcrypt(request(Str::random()))
                ]);
            }

            Auth::login($user, true);
            $array = ['user' => $user->name, 'success' => 'Logged In Succesfully'];
            return redirect()->route('user.home')->with('data', $array);
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', 'Error logging in using google, please try again');
        }
    }
}
