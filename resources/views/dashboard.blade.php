<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Ecommerce Auth</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Syne:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0f1b32;
            --muted: #5d6780;
            --line: rgba(15, 27, 50, 0.12);
            --card: rgba(255, 255, 255, 0.88);
            --brand: #0c5fd6;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Manrope", "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 8% 0%, rgba(12, 95, 214, 0.2), transparent 42%),
                radial-gradient(circle at 95% 8%, rgba(11, 153, 101, 0.16), transparent 36%),
                linear-gradient(140deg, #eef4ff 0%, #f8fbff 52%, #edf7f2 100%);
            padding: 26px;
        }

        .nav {
            max-width: 1080px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-family: "Syne", sans-serif;
            letter-spacing: .02em;
            font-size: 1.1rem;
            color: #0a4ca9;
            text-decoration: none;
        }

        .btn-link {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 8px 12px;
            color: var(--ink);
            font-weight: 600;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.7);
        }

        .grid {
            max-width: 1080px;
            margin: 0 auto;
            display: grid;
            gap: 16px;
            grid-template-columns: 1.4fr 1fr;
        }

        .card {
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--card);
            box-shadow: 0 18px 38px rgba(15, 27, 50, 0.12);
            padding: 24px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: clamp(1.8rem, 4vw, 2.4rem);
            letter-spacing: -.02em;
        }

        p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .kpi {
            margin-top: 16px;
            display: grid;
            gap: 10px;
        }

        .kpi-item {
            border: 1px dashed rgba(12, 95, 214, 0.35);
            background: rgba(12, 95, 214, 0.06);
            border-radius: 12px;
            padding: 10px 12px;
            font-size: .92rem;
            color: #1f3f78;
        }

        .kpi-item strong {
            color: #123261;
        }

        .actions {
            margin-top: 14px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 700;
            font-size: .92rem;
        }

        .btn-primary {
            color: #fff;
            background: linear-gradient(120deg, #0c5fd6, #083f9d);
            box-shadow: 0 12px 20px rgba(12, 95, 214, 0.25);
        }

        .btn-ghost {
            color: var(--ink);
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.74);
        }

        .status {
            margin-top: 14px;
            padding: 12px;
            border: 1px solid rgba(11, 153, 101, 0.3);
            border-radius: 12px;
            background: rgba(11, 153, 101, 0.08);
            color: #136145;
            font-weight: 600;
            font-size: .92rem;
        }

        @media (max-width: 900px) {
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header class="nav">
        <a href="{{ url('/') }}" class="logo">ecommerce-app</a>
        <a href="#" class="btn-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    </header>

    <main class="grid">
        <section class="card">
            <h1>Welcome, {{ auth()->user()->name }}.</h1>
            <p>Your account is active on the authorization server and ready for connected OAuth client applications.</p>
            <div class="kpi">
                <div class="kpi-item"><strong>Email:</strong> {{ auth()->user()->email }}</div>
                <div class="kpi-item"><strong>Guard:</strong> Web session</div>
                <div class="kpi-item"><strong>OAuth role:</strong> Authorization Server User</div>
            </div>
        </section>

        <aside class="card">
            <h2 style="margin:0 0 8px;font-size:1.2rem;">SSO Status</h2>
            <p>Foodpanda and any registered client can request authorization through Passport.</p>
            <div class="status">Ready to issue authorization codes.</div>
            <div class="actions">
                <a class="btn btn-primary" href="{{ url('/') }}">Open Home</a>
                <a class="btn btn-ghost" href="{{ route('login') }}">Login Page</a>
            </div>
        </aside>
    </main>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</body>
</html>
