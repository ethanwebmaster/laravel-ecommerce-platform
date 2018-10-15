<?php

namespace Corals\Foundation\Http\Controllers;

class AuthBaseController extends BaseController
{

    protected $redirectTo;

    /**
     * AuthBaseController constructor.
     */
    public function __construct()
    {
        $this->redirectTo = \Filters::do_filter('auth_redirect_to', 'dashboard');

        parent::__construct();
    }

    public function setTheme()
    {
        $auth_theme = \Filters::do_filter('auth_theme', \Settings::get('active_admin_theme', config('themes.corals_admin')));

        \Theme::set($auth_theme);
    }
}