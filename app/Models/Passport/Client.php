<?php

namespace App\Models\Passport;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    /**
     * Skip consent only for trusted internal apps that the user has already authorized once.
     *
     * @param  array<int, \Laravel\Passport\Scope>  $scopes
     */
    public function skipsAuthorization(Authenticatable $user, array $scopes): bool
    {
        if (!config('passport.auto_approve_trusted_clients', false)) {
            return false;
        }

        if (! $this->isTrustedClient()) {
            return false;
        }

        return $this->tokens()
            ->where('user_id', $user->getAuthIdentifier())
            ->where('revoked', false)
            ->where('expires_at', '>', now())
            ->exists();
    }

    private function isTrustedClient(): bool
    {
        $trustedIds = array_map('strval', config('passport.trusted_client_ids', []));
        $trustedNames = array_map('strval', config('passport.trusted_client_names', []));

        return in_array((string) $this->getKey(), $trustedIds, true)
            || in_array((string) $this->name, $trustedNames, true);
    }
}
