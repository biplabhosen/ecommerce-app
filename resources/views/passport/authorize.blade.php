<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Authorize Application</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        .container { max-width: 600px; margin: auto; }
        .buttons { margin-top: 1rem; }
    </style>
</head>
<body>
<div class="container">
    <h2>Authorize "{{ $client->name }}"</h2>
    <p>The application <strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>

    @if (isset($scopes) && count($scopes) > 0)
        <div>
            <p><strong>Requested Scopes</strong></p>
            <ul>
                @foreach ($scopes as $scope)
                    <li>{{ $scope->description ?? $scope->id }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('passport.authorizations.approve') }}">
        @csrf
        <input type="hidden" name="auth_token" value="{{ $authToken }}">
        <input type="hidden" name="state" value="{{ $request->get('state') }}">
        <button type="submit">Authorize</button>
    </form>

    <form method="post" action="{{ route('passport.authorizations.deny') }}" style="margin-top: 0.5rem;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="auth_token" value="{{ $authToken }}">
        <input type="hidden" name="state" value="{{ $request->get('state') }}">
        <button type="submit">Deny</button>
    </form>
</div>
</body>
</html>
