<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/index.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="continent">
        <div class="login-area">
            <div class="padding-30">
                <form action="{{ route('postLogin') }}" method="POST">
                    @csrf
                    <h2 class="login-title">Login</h2>
                    <label class="login-lable" for="">Email</label><br>
                    <input class="login-input" type="email" placeholder="Email" name="email"><br>
                    <label class="login-lable" for="">Password</label><br>
                    <input class="login-input" type="password" placeholder="Password" name="password"><br>
                    <input class="login-submit" type="submit" value="Đăng Nhập">
                </form>
            </div>
        </div>
    </div>
</body>
</html>