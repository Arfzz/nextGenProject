<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — NextGen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #132440;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .login-card__brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-card__brand h1 {
            font-size: 28px;
            font-weight: 700;
            color: #132440;
        }

        .login-card__brand h1 span {
            color: #F2BC45;
        }

        .login-card__brand p {
            font-size: 14px;
            color: #7F7F7F;
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #132440;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #F2BC45;
            box-shadow: 0 0 0 3px rgba(242, 188, 69, 0.15);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #F2BC45;
            color: #132440;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: #d9a83a;
            transform: translateY(-1px);
        }

        .error-msg {
            background: #FFD1D1;
            color: #B23030;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-card__brand">
            <h1><span>Next</span>Gen</h1>
            <p>Admin Login</p>
        </div>

        @if($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="admin@example.com">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>

</html>