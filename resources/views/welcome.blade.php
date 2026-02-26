<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ecommerce SSO') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Literata:opsz,wght@7..72,600;7..72,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #101522;
            --paper: #f3f6fb;
            --card: rgba(255, 255, 255, 0.82);
            --brand: #0c5fd6;
            --brand-dark: #08439b;
            --muted: #5b667d;
            --line: rgba(16, 21, 34, 0.12);
            --ok: #0b9965;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Space Grotesk", "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 10% 5%, rgba(12, 95, 214, 0.2), transparent 40%),
                radial-gradient(circle at 92% 12%, rgba(11, 153, 101, 0.16), transparent 35%),
                linear-gradient(145deg, #ecf1fa 0%, #f7fbff 44%, #eef6f4 100%);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .page {
            width: min(1120px, 100%);
            border-radius: 26px;
            border: 1px solid var(--line);
            background: var(--card);
            backdrop-filter: blur(10px);
            box-shadow: 0 30px 60px rgba(7, 18, 39, 0.14);
            overflow: hidden;
        }

        .layout {
            display: grid;
            grid-template-columns: 1.2fr 0.9fr;
            min-height: 620px;
        }

        .hero {
            padding: 52px 54px;
            position: relative;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(12, 95, 214, 0.1);
            color: #0b4ca9;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 26px;
            animation: reveal .5s ease-out both;
        }

        .badge::before {
            content: "";
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--ok);
            box-shadow: 0 0 0 5px rgba(11, 153, 101, 0.18);
        }

        h1 {
            margin: 0;
            font-family: "Literata", Georgia, serif;
            font-size: clamp(2rem, 4vw, 3.35rem);
            line-height: 1.12;
            letter-spacing: -0.02em;
            animation: reveal .7s .08s ease-out both;
        }

        .lead {
            margin-top: 18px;
            color: var(--muted);
            font-size: clamp(1rem, 2vw, 1.15rem);
            line-height: 1.7;
            max-width: 640px;
            animation: reveal .7s .16s ease-out both;
        }

        .cta-row {
            margin-top: 32px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            animation: reveal .7s .24s ease-out both;
        }

        .btn {
            text-decoration: none;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.96rem;
            transition: transform .22s ease, box-shadow .22s ease, background-color .22s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--brand), var(--brand-dark));
            color: #fff;
            box-shadow: 0 12px 20px rgba(12, 95, 214, 0.25);
        }

        .btn-secondary {
            border: 1px solid var(--line);
            color: var(--ink);
            background: rgba(255, 255, 255, 0.74);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary:hover {
            box-shadow: 0 16px 24px rgba(12, 95, 214, 0.3);
        }

        .steps {
            margin-top: 40px;
            display: grid;
            gap: 14px;
            animation: reveal .7s .32s ease-out both;
        }

        .step {
            display: grid;
            grid-template-columns: 34px 1fr;
            gap: 12px;
            align-items: start;
        }

        .step-number {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(12, 95, 214, 0.12);
            color: #0a54bc;
            display: grid;
            place-items: center;
            font-weight: 700;
            font-size: 13px;
        }

        .step p {
            margin: 4px 0 0;
            color: var(--muted);
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .side {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.78), rgba(232, 243, 255, 0.88));
            border-left: 1px solid var(--line);
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            gap: 18px;
            justify-content: center;
            animation: reveal .75s .18s ease-out both;
        }

        .panel {
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 18px;
            background: rgba(255, 255, 255, 0.92);
        }

        .panel h2, .panel h3 {
            margin: 0;
            font-size: 1.1rem;
            letter-spacing: -0.01em;
        }

        .panel h3 {
            font-size: 0.98rem;
        }

        .panel p {
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.55;
            font-size: 0.93rem;
        }

        .creds {
            display: grid;
            gap: 10px;
            margin-top: 12px;
            font-size: 0.92rem;
        }

        .kv {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            background: rgba(12, 95, 214, 0.06);
            border: 1px dashed rgba(12, 95, 214, 0.35);
            border-radius: 10px;
            padding: 10px 12px;
        }

        .kv strong {
            color: #194286;
            font-weight: 600;
        }

        .panel code {
            font-family: "Courier New", monospace;
            font-weight: 700;
            color: #0a3f90;
            word-break: break-all;
        }

        @keyframes reveal {
            from {
                transform: translateY(14px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 980px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .side {
                border-left: 0;
                border-top: 1px solid var(--line);
            }

            .hero {
                padding: 42px 28px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="layout">
            <div class="hero">
                <div class="badge">OAuth2 Authorization Server Ready</div>
                <h1>Central Login for Ecommerce and Foodpanda App</h1>
                <p class="lead">
                    This ecommerce app acts as the OAuth2 Authorization Server using Laravel Passport.
                    Log in once here, authorize the client, and your account session can be reused from the
                    Foodpanda client through Authorization Code Grant.
                </p>

                <div class="cta-row">
                    @auth
                        <a class="btn btn-primary" href="{{ route('dashboard') }}">Go to Dashboard</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">Login to Ecommerce</a>
                        <a class="btn btn-secondary" href="{{ route('register') }}">Create Account</a>
                    @endauth
                </div>

                <div class="steps">
                    <div class="step">
                        <span class="step-number">01</span>
                        <p>User signs in to ecommerce authorization server.</p>
                    </div>
                    <div class="step">
                        <span class="step-number">02</span>
                        <p>Foodpanda redirects to <code>/oauth/authorize</code> with client and state.</p>
                    </div>
                    <div class="step">
                        <span class="step-number">03</span>
                        <p>Passport returns authorization code, Foodpanda exchanges it for token and fetches user profile.</p>
                    </div>
                </div>
            </div>

            <aside class="side">
                <div class="panel">
                    <h2>Visitor Test Credentials</h2>
                    <p>Use this account to test SSO from Foodpanda client.</p>
                    <div class="creds">
                        <div class="kv">
                            <strong>Email</strong>
                            <code>biplobhosen214@gmail.com</code>
                        </div>
                        <div class="kv">
                            <strong>Password</strong>
                            <code>12369874</code>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <h3>Client Callback</h3>
                    <p>Foodpanda callback endpoint must match Passport client redirect URI: <code>/oauth/callback</code>.</p>
                </div>

                <div class="panel">
                    <h3>Token Endpoint</h3>
                    <p>Foodpanda exchanges code at <code>/oauth/token</code> and fetches authenticated user from <code>/api/user</code>.</p>
                </div>
            </aside>
        </section>
    </main>
</body>
</html>
