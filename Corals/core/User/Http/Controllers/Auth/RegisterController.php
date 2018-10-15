<?php

namespace Corals\User\Http\Controllers\Auth;

use App\Exceptions\Handler;
use Corals\User\Facades\TwoFactorAuth;
use Corals\User\Models\User;
use Corals\Foundation\Http\Controllers\AuthBaseController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends AuthBaseController
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->corals_middleware = ['guest'];
        parent::__construct();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required',
            'phone_country_code' => 'required',
            'phone_number' => 'required|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \Corals\User\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_country_code' => $data['phone_country_code'],
            'phone_number' => $data['phone_number']
        ]);

        try {

            TwoFactorAuth::register($user);

            return $user;
        } catch (\Exception $exception) {
            $user->forceDelete();

            app(Handler::class)->report($exception);

            return response()->json(['error' => ['Unable To Register User']], 422);
        }
    }

    /**
     * Handle a registration request for the application.
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|mixed
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        \Actions::do_action('user_registered', $user);

        if (TwoFactorAuth::isEnabled($user)) {
            $request->session()->put('authy:auth:id', $user->id);

            return redirectTo(url('auth/token'));
        }

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirectTo($this->redirectPath());
    }
}
