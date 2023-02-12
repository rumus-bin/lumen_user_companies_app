<?php

namespace App\Providers;

use App\Models\User\Repositories\UserAuthTokenRepository;
use app\Models\User\User;
use App\Models\User\UserAuthToken;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function (Request $request) {
            if ($request->bearerToken()) {
                /** @var UserAuthTokenRepository $authRepository */
                $authRepository = app(UserAuthTokenRepository::class);
                $authTokenModel = $authRepository->findOneByField(
                    UserAuthToken::AUTH_TOKEN,
                    $request->bearerToken()
                );

                return $authTokenModel?->user;
            }

            throw new NotFoundHttpException();
        });
    }
}
