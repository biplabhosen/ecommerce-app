<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Ecommerce Auth</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Syne:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #101a33;
            --muted: #59637a;
            --line: rgba(16, 26, 51, 0.14);
            --card: rgba(255, 255, 255, 0.88);
            --brand-a: #0d64dd;
            --brand-b: #0740a8;
            --danger-bg: #ffecee;
            --danger-border: #efb4bb;
            --danger-text: #8c1d2b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Manrope", "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 0% 10%, rgba(13, 100, 221, 0.23), transparent 43%),
                radial-gradient(circle at 95% 0%, rgba(11, 156, 119, 0.17), transparent 33%),
                linear-gradient(145deg, #f0f5ff 0%, #f9fcff 44%, #eef8f7 100%);
            display: grid;
            place-items: center;
            padding: 20px;
        }

        .card {
            width: min(510px, 100%);
            border-radius: 20px;
            border: 1px solid var(--line);
            background: var(--card);
            box-shadow: 0 22px 50px rgba(16, 26, 51, 0.15);
            padding: 30px;
        }

        .brand {
            text-decoration: none;
            font-family: "Syne", sans-serif;
            font-size: 1.15rem;
            color: #0d4ca8;
            letter-spacing: .02em;
        }

        h1 {
            margin: 16px 0 6px;
            font-size: clamp(1.7rem, 4vw, 2.2rem);
            letter-spacing: -.02em;
        }

        p {
            margin: 0 0 20px;
            color: var(--muted);
        }

        .alert {
            margin-bottom: 14px;
            border: 1px solid var(--danger-border);
            background: var(--danger-bg);
            color: var(--danger-text);
            border-radius: 10px;
            padding: 10px 12px;
            font-size: .9rem;
        }

        .field {
            margin-bottom: 14px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: .92rem;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 11px 12px;
            font-size: .95rem;
            font-family: inherit;
            color: var(--ink);
            background: rgba(255, 255, 255, 0.94);
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #2d7cf3;
            box-shadow: 0 0 0 3px rgba(13, 100, 221, 0.16);
        }

        .error {
            margin-top: 5px;
            color: #b3261e;
            font-size: .84rem;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin: 2px 0 14px;
            color: var(--muted);
            font-size: .9rem;
        }

        .row label {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            margin: 0;
            font-weight: 500;
        }

        .btn {
            width: 100%;
            border: 0;
            border-radius: 10px;
            padding: 11px 14px;
            font-weight: 700;
            font-size: .95rem;
            color: #fff;
            background: linear-gradient(120deg, var(--brand-a), var(--brand-b));
            cursor: pointer;
            box-shadow: 0 14px 22px rgba(13, 100, 221, 0.25);
        }

        .foot {
            margin-top: 14px;
            text-align: center;
            font-size: .92rem;
            color: var(--muted);
        }

        .foot a {
            color: #0d4ca8;
            font-weight: 700;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <main class="card">
        <a href="{{ url('/') }}" class="brand">ecommerce-app</a>
        <h1>Sign in to continue</h1>
        <p>Use your account to access SSO authorization and client integrations.</p>

        @if ($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <label for="remember">
                    <input type="checkbox" id="remember" name="remember">
                    Remember me
                </label>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <p class="foot">
            New user? <a href="{{ route('register') }}">Create account</a>
        </p>
    </main>
</body>
</html>
