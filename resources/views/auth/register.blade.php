<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Ecommerce Auth</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Syne:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #111d35;
            --muted: #59637a;
            --line: rgba(17, 29, 53, 0.14);
            --card: rgba(255, 255, 255, 0.89);
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
                radial-gradient(circle at 5% 0%, rgba(13, 100, 221, 0.22), transparent 44%),
                radial-gradient(circle at 96% 4%, rgba(18, 143, 111, 0.16), transparent 34%),
                linear-gradient(150deg, #eef4ff 0%, #f9fbff 50%, #edf7f4 100%);
            display: grid;
            place-items: center;
            padding: 20px;
        }

        .card {
            width: min(550px, 100%);
            border-radius: 20px;
            border: 1px solid var(--line);
            background: var(--card);
            box-shadow: 0 24px 52px rgba(17, 29, 53, 0.15);
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

        .field { margin-bottom: 14px; }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: .92rem;
            font-weight: 600;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 11px 12px;
            font-size: .95rem;
            font-family: inherit;
            color: var(--ink);
            background: rgba(255, 255, 255, 0.95);
        }

        input:focus {
            outline: none;
            border-color: #2d7cf3;
            box-shadow: 0 0 0 3px rgba(13, 100, 221, 0.16);
        }

        .error {
            margin-top: 5px;
            color: #b3261e;
            font-size: .84rem;
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
        <h1>Create your account</h1>
        <p>Register once and use the same identity for connected client apps.</p>

        @if ($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label for="name">Full name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="password-confirm">Confirm password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn">Register</button>
        </form>

        <p class="foot">
            Already registered? <a href="{{ route('login') }}">Sign in</a>
        </p>
    </main>
</body>
</html>
