<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\\Models\\Model' => 'App\\Policies\\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Register Passport routes necessary for issuing tokens, revoking, clients, etc.
        // the package automatically registers its routes in PassportServiceProvider but
        // calling `Passport::routes()` here ensures the helper methods are available
        // and is the common location to configure additional behaviour such as the
        // authorization view for the consent screen.

        // Authorization Code Grant is enabled by default when you create a client with
        // `php artisan passport:client --personal=false --password=false`.

        // token expiration configuration (example values, read from env if needed)
        Passport::tokensExpireIn(Carbon::now()->addDays(env('PASSPORT_TOKEN_EXPIRES', 15)));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(env('PASSPORT_REFRESH_TOKEN_EXPIRES', 30)));

        // It's a good practice to limit scopes here or configure them elsewhere.
        // Passport::tokensCan([...]);

        // --- view binding for the OAuth authorization page ---
        // Passport needs a concrete implementation of the
        // `AuthorizationViewResponse` contract when serving the /oauth/authorize
        // page.  By default no binding exists, which results in the
        // BindingResolutionException you saw.  We register a simple view-based
        // response and publish the default templates so the user can consent.
        Passport::viewPrefix('passport');
        // database when the authorization code request is made. Ensure that clients are created
        // with the correct `redirect_uri` value for security.
    }
}
