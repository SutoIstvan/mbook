<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // $referer = $request->headers->get('referer');

        // if ($referer && (
        //     $referer == url('/') || 
        //     // $referer == route('home') || 
        //     $referer == url('/login')
        // )) {
        //     return redirect()->route('dashboard');
        // }

        // Перенаправляем на предыдущую страницу или на /dashboard по умолчанию
        return redirect()->intended($this->redirectTo);
    }
}
