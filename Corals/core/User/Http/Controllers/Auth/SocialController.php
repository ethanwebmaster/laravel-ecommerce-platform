<?php

namespace Corals\User\Http\Controllers\Auth;

use Corals\Foundation\Http\Controllers\AuthBaseController;

use Corals\User\Models\SocialAccount;
use Corals\User\Models\User;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends AuthBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Social   Controller
    |--------------------------------------------------------------------------
    |
    */

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

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();

        $user = $this->findOrCreateUser($provider, $socialiteUser);

        auth()->login($user, true);

        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($provider, $socialiteUser)
    {
        if ($user = $this->findUserBySocialId($provider, $socialiteUser->getId())) {
            return $user;
        }

        if ($user = $this->findUserByEmail($provider, $socialiteUser->getEmail())) {
            $this->addSocialAccount($provider, $user, $socialiteUser);

            return $user;
        }

        $user = User::create([
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
            'password' => bcrypt(str_random(25)),
        ]);

        \Actions::do_action('social_registration', $user);

        $this->addSocialAccount($provider, $user, $socialiteUser);

        return $user;
    }

    public function findUserBySocialId($provider, $id)
    {
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_id', $id)
            ->first();

        return $socialAccount ? $socialAccount->user : false;
    }

    public function findUserByEmail($provider, $email)
    {
        return !$email ? null : User::where('email', $email)->first();
    }

    public function addSocialAccount($provider, $user, $socialiteUser)
    {
        SocialAccount::create([
            'user_id' => $user->id,
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId(),
            'token' => $socialiteUser->token,
        ]);
    }

}
