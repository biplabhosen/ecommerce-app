<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Authorize App | Ecommerce SSO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Syne:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0f1a31;
            --muted: #5a647d;
            --line: rgba(15, 26, 49, 0.14);
            --card: rgba(255, 255, 255, 0.9);
            --brand: #0c5fd6;
            --danger: #bf2338;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Manrope", "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 8% 0%, rgba(12, 95, 214, 0.2), transparent 40%),
                radial-gradient(circle at 96% 8%, rgba(11, 153, 101, 0.15), transparent 36%),
                linear-gradient(145deg, #eef4ff 0%, #f7fbff 55%, #edf7f3 100%);
            display: grid;
            place-items: center;
            padding: 20px;
        }

        .card {
            width: min(700px, 100%);
            border-radius: 20px;
            border: 1px solid var(--line);
            background: var(--card);
            box-shadow: 0 24px 54px rgba(15, 26, 49, 0.14);
            padding: 28px;
        }

        .eyebrow {
            font-family: "Syne", sans-serif;
            letter-spacing: .03em;
            color: #0a4ca9;
            font-size: .95rem;
        }

        h1 {
            margin: 10px 0 8px;
            font-size: clamp(1.5rem, 3.5vw, 2.2rem);
            letter-spacing: -.02em;
        }

        p {
            margin: 0;
            line-height: 1.6;
            color: var(--muted);
        }

        .meta {
            margin-top: 16px;
            display: grid;
            gap: 9px;
        }

        .meta-item {
            border: 1px dashed rgba(12, 95, 214, 0.3);
            background: rgba(12, 95, 214, 0.06);
            border-radius: 10px;
            padding: 10px 12px;
            font-size: .92rem;
        }

        .meta-item strong {
            color: #13346a;
        }

        .scope-wrap {
            margin-top: 16px;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 14px;
            background: rgba(255, 255, 255, 0.72);
        }

        .scope-title {
            margin: 0 0 8px;
            font-size: .95rem;
            font-weight: 700;
        }

        ul {
            margin: 0;
            padding-left: 18px;
            color: var(--muted);
        }

        .none {
            color: var(--muted);
            font-size: .92rem;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn {
            border: 0;
            border-radius: 10px;
            padding: 11px 16px;
            font-size: .93rem;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-allow {
            color: #fff;
            background: linear-gradient(120deg, var(--brand), #0a439f);
            box-shadow: 0 12px 20px rgba(12, 95, 214, 0.24);
        }

        .btn-deny {
            color: #fff;
            background: linear-gradient(120deg, var(--danger), #9c1629);
            box-shadow: 0 12px 20px rgba(191, 35, 56, 0.22);
        }
    </style>
</head>
<body>
    <main class="card">
        <div class="eyebrow">OAuth Authorization Request</div>
        <h1>Authorize "{{ $client->name }}"</h1>
        <p>This app is requesting access to your account on ecommerce authorization server.</p>

        <div class="meta">
            <div class="meta-item"><strong>Client:</strong> {{ $client->name }}</div>
            <div class="meta-item"><strong>Signed in as:</strong> {{ $user->email }}</div>
        </div>

        <div class="scope-wrap">
            <p class="scope-title">Requested scopes</p>
            @if (isset($scopes) && count($scopes) > 0)
                <ul>
                    @foreach ($scopes as $scope)
                        <li>{{ $scope->description ?? $scope->id }}</li>
                    @endforeach
                </ul>
            @else
                <p class="none">No custom scopes requested.</p>
            @endif
        </div>

        <div class="actions">
            <form method="post" action="{{ route('passport.authorizations.approve') }}">
                @csrf
                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                <input type="hidden" name="state" value="{{ $request->get('state') }}">
                <button type="submit" class="btn btn-allow">Authorize Access</button>
            </form>

            <form method="post" action="{{ route('passport.authorizations.deny') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                <input type="hidden" name="state" value="{{ $request->get('state') }}">
                <button type="submit" class="btn btn-deny">Deny</button>
            </form>
        </div>
    </main>
</body>
</html>
