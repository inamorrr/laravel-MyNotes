<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h3>Login</h3>
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div> @endif
    <form method="POST" action="/login">@csrf
        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
        <button class="btn btn-outline-dark">Login</button>
    </form>
    <p class="mt-2">Belum punya akun? <a href="/register">Register</a></p>
</body>

</html>