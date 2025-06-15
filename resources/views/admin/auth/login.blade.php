<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - EcoShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #eaeaea;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            background-color: #1c1c1c;
            border: 1px solid #333;
            box-shadow: 0 0 10px rgba(0,0,0,0.6);
        }

        .form-control {
            background-color: #2b2b2b;
            color: #f1f1f1;
            border: 1px solid #444;
        }

        .form-control:focus {
            border-color: #1c88ff;
            box-shadow: 0 0 0 0.2rem rgba(28, 136, 255, 0.25);
        }

        label {
            color: #ccc;
        }

        .btn-primary {
            background-color: #1c88ff;
            border: none;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #136ad5;
        }

        .text-info-link {
            color: #00bcd4;
        }

        .text-info-link:hover {
            color: #4dd0e1;
        }

        .error-text {
            color: #ff6b6b;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="card p-4 rounded" style="width: 100%; max-width: 420px;">
            <h2 class="text-center text-info mb-4">Admin Login</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Admin Email</label>
                    <input id="email" type="email" name="email" class="form-control" placeholder="Enter admin email" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Admin Password</label>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

                <div class="text-center">
                    <a href="{{ route('home') }}" class="text-info-link">← Back to Store</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
