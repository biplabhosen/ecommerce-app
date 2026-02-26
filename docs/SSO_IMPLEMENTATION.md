# Ecommerce + Foodpanda OAuth2 SSO Implementation

## Objective

Implement Single Sign-On where:

- `ecommerce` is the OAuth2 Authorization Server (Laravel Passport).
- `foodpanda` is the OAuth2 Client (Authorization Code Grant).
- A user logs in once on ecommerce, then can authenticate in foodpanda through OAuth redirect/callback.

## Apps and Roles

| App | Role | Base URL (local) |
|---|---|---|
| ecommerce | Authorization Server (Passport) | `http://localhost:8000` |
| foodpanda | OAuth Client | `http://localhost:8001` |

## What Is Implemented

### In `ecommerce` (authorization server)

- Passport-enabled API user endpoint: `GET /api/user` protected by `auth:api`.
- Authorization consent screen view under `resources/views/passport/authorize.blade.php`.
- Professional landing page (`resources/views/welcome.blade.php`) with SSO overview and test credentials.
- Deterministic test account seeding in `database/seeders/DatabaseSeeder.php`:
  - Email: `biplobhosen214@gmail.com`
  - Password: `12369874`
- Session migration added (`database/migrations/2026_02_26_100000_create_sessions_table.php`) for stable session-backed login and consent flow.

### In `foodpanda` (OAuth client)

- OAuth routes:
  - `/redirect` starts authorization request
  - `/oauth/callback` handles callback
  - `/dashboard` protected local dashboard
- `OAuthController` handles:
  - state generation and session persistence
  - state validation on callback
  - auth code exchange at `/oauth/token`
  - user profile fetch from `/api/user`
  - local user create/update and local login
- Error handling improved for missing config, invalid state, token failures, and invalid provider payload.
- OAuth server URL normalization added (adds `https://` if protocol missing).
- Session migration added (`database/migrations/2026_02_26_100000_create_sessions_table.php`).

## Required Environment Configuration

### 1) ecommerce (`.env`)

Set at minimum:

```dotenv
APP_URL=http://localhost:8000
SESSION_DRIVER=database
```

### 2) foodpanda (`.env`)

Set:

```dotenv
APP_URL=http://localhost:8001
SESSION_DRIVER=database
OAUTH_CLIENT_ID=your-passport-client-id
OAUTH_CLIENT_SECRET=your-passport-client-secret
OAUTH_REDIRECT_URI=http://localhost:8001/oauth/callback
OAUTH_SERVER_URL=http://localhost:8000
```

`OAUTH_SERVER_URL` can be a full URL (`https://...`) or host (`example.com`), but full URL is recommended.

## Setup Steps

### A) Ecommerce setup

1. Install dependencies:
   ```bash
   composer install
   ```
2. Run migrations and seed test user:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
3. Install Passport keys and tables (if not already done):
   ```bash
   php artisan passport:install
   ```
4. Create Authorization Code client for foodpanda:
   ```bash
   php artisan passport:client --name="foodpanda-app" --redirect_uri="http://localhost:8001/oauth/callback"
   ```
5. Copy generated `client_id` and `client_secret` into foodpanda `.env`.

### B) Foodpanda setup

1. Install dependencies:
   ```bash
   composer install
   ```
2. Run migrations:
   ```bash
   php artisan migrate
   ```
3. Configure OAuth values in `.env`.

## Runtime Flow (Authorization Code Grant)

1. User opens foodpanda and clicks **Login with Ecommerce**.
2. Foodpanda creates a random `state`, stores it in session, and redirects to:
   - `ecommerce/oauth/authorize?...`
3. User logs in on ecommerce (if not logged in).
4. Ecommerce shows consent page and user approves.
5. Ecommerce redirects back to foodpanda callback with `code` and `state`.
6. Foodpanda validates `state`.
7. Foodpanda exchanges `code` at ecommerce `/oauth/token` for `access_token`.
8. Foodpanda calls ecommerce `/api/user` with bearer token.
9. Foodpanda creates/updates local user and logs in user locally.

## Test Credentials

Use the seeded ecommerce account:

- Email: `biplobhosen214@gmail.com`
- Password: `12369874`

## Quick Verification Checklist

1. Open `http://localhost:8000` and verify new professional homepage shows test credentials.
2. Login to ecommerce with test account.
3. Open `http://localhost:8001` and click **Login with Ecommerce**.
4. Complete consent, ensure redirect lands on foodpanda dashboard as authenticated user.
5. Logout from foodpanda and retry login to confirm repeatability.

## Common Issues

- `Invalid or expired OAuth state`:
  - session table missing or session not persisted.
  - fix by running migrations in both apps and ensuring cookies are not blocked.
- `Token request failed`:
  - wrong client ID/secret or redirect URI mismatch.
- callback mismatch:
  - Passport client redirect URI must exactly match `OAUTH_REDIRECT_URI`.
