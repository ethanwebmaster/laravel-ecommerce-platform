<?php

namespace Corals\User\Http\Controllers\Auth;

use Corals\Foundation\Http\Controllers\AuthBaseController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends AuthBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->corals_middleware = ['guest'];
        parent::__construct();
    }
}
