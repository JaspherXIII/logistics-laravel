<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     * 
     * @var string
     */
    protected $redirectTo = '/welcome'; 
    protected function redirectTo(){
        if(auth()->check()) {
            if(auth()->user()->role == 1) {
                return $this->redirectToWithSuccess(route('admin.dashboard'), 'Welcome to Admin Dashboard!');
            } elseif(auth()->user()->role == 2) {
                return $this->redirectToWithSuccess(route('user.dashboard'), 'Welcome to User Dashboard!');
            }
        }
        
        // Default redirect if user role is not 1 or 2, or user is not authenticated
        return $this->redirectToWithSuccess(route('default.dashboard'), 'Welcome to Default Dashboard!');
    }
    
    protected function redirectToWithSuccess($route, $message) {
        session()->flash('success', $message);
        return $route;
    }
    
      
}
