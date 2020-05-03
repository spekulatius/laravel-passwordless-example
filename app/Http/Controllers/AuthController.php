<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\SigninEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    /**
     * Processes the login form
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     **/
    public function login(Request $request)
    {
        // find the user for the email - or create it.
        $user = User::firstOrCreate(
            ['email' => $request->post('email')],
            ['name' => $request->post('email'), 'password' => Str::random()]
        );

        // create a signed URL for login
        $url = URL::temporarySignedRoute(
            'sign-in',
            now()->addMinutes(30),
            ['user' => $user->id]
        );

        // send the email
        Mail::send(new SigninEmail($user, $url));

        // inform the user
        return view('login-sent');
    }

    /**
     * Processes the actual login
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return redirect
     **/
    public function signIn(Request $request, $user)
    {
        // Check if the URL is valid
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        // Authenticate the user
        $user = User::findOrFail($user);
        Auth::login($user);

        // Redirect to homepage
        return redirect('/');
    }

    /**
     * Processes the logout
     *
     * @param \Illuminate\Http\Request $request
     * @return redirect
     **/
    public function logout(Request $request)
    {
        // logout
        Auth::logout();

        // Redirect to homepage
        return redirect('/');
    }
}