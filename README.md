# Ecommerce OAuth2 Authorization Server

## Overview

This repository is the **OAuth2 Authorization Server** for the multi-login SSO system.
It is built with Laravel Passport and issues authorization codes/tokens for client apps such as `foodpanda`.

## Core Features

- Laravel Passport Authorization Code Grant
- Login and registration UI for provider users
- OAuth consent screen with first-time consent behavior
- Trusted internal app flow: first consent, then auto-approve on next authorizations
- Test account seeded for quick QA

## Test Credentials

- Email: `biplobhosen214@gmail.com`
- Password: `12369874`

## SSO Behavior

1. Foodpanda redirects user to `ecommerce /oauth/authorize`.
2. If user is **not logged in** on ecommerce, Passport redirects to ecommerce login page.
3. If user **is logged in**, Passport opens the consent page.
4. Consent is shown on first authorization; then trusted internal clients are auto-approved on subsequent requests.

## Trusted Internal App Auto-Approval

Configure in `.env`:

```dotenv
PASSPORT_AUTO_APPROVE_TRUSTED_CLIENTS=true
PASSPORT_TRUSTED_CLIENT_IDS=
PASSPORT_TRUSTED_CLIENT_NAMES=foodpanda-app
```

- Match by client `id` or `name` from `oauth_clients`.
- Trusted clients skip consent **after** first successful authorization.

## Local Setup

1. Install dependencies:
   ```bash
   composer install
   ```
2. Create env and key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Configure DB in `.env`.
4. Migrate and seed:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
5. Install Passport keys/clients tables if needed:
   ```bash
   php artisan passport:install
   ```
6. Create OAuth client for foodpanda:
   ```bash
   php artisan passport:client --name="foodpanda-app" --redirect_uri="http://localhost:8001/oauth/callback"
   ```
7. Start app:
   ```bash
   php artisan serve --port=8000
   ```

## Railway Deployment (Provider)

1. Push this repository to GitHub.
2. In Railway, create a new project from repo.
3. Add MySQL database service and attach variables to app service.
4. Set required env vars (`APP_ENV`, `APP_KEY`, DB vars, Passport vars, session vars).
5. Build command:
   ```bash
   composer install --no-interaction --prefer-dist --optimize-autoloader
   ```
6. Start command:
   ```bash
   php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```
7. Configure `APP_URL` to Railway public domain.

## Documentation

- Full architecture and flow: `docs/SSO_IMPLEMENTATION.md`

## Deliverables Checklist

- [x] GitHub repository with implementation
- [x] README with setup instructions
- [x] Deployment steps for Railway
- [ ] Live demo URL: `<add-after-deploy>`
- [x] Test credentials documented

