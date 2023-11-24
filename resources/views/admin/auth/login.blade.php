<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture Login and Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .switch-form {
            text-align: center;
            font-size: 14px;
        }

        .switch-form a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>

    </header>

    <div class="container">
        <h1>Admin Login</h1>

        <!-- Login Form -->
        <form id="login-form" class="form-group" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <label for="login-username">Username</label>
            <input type="text" id="login-username" name="email" required>
            <label for="login-password">Password</label>
            <input type="password" id="login-password" name="password" required>
            <button type="submit">Login</button>
        </form>

        <!-- Registration Form -->
        <form id="register-form" class="form-group" style="display:none;" method="POST" action="{{ route('admin.register') }}">
            @csrf
            <label for="register-username">Name</label>
            <input type="text" id="register-username" name="name" required>
            
            <label for="register-username">Email</label>
            <input type="text" id="register-username" name="email" required>
            
            <label for="register-password">Password</label>
            <input type="password" id="register-password" name="password" required>

            <label for="register-password">Confirm Password</label>
            <input type="password" id="register-password" name="password_confirmation" required>

            <button type="submit">Register</button>
        </form>

        <!-- Switch between Login and Register -->
        <div class="switch-form">
            <p>Don't have an account? <a href="#" id="switch-to-register">Register here</a>.</p>
            <p>Already have an account? <a href="#" id="switch-to-login">Login here</a>.</p>
        </div>
    </div>

    <script>
        document.getElementById('switch-to-register').addEventListener('click', function() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
        });

        document.getElementById('switch-to-login').addEventListener('click', function() {
            document.getElementById('register-form').style.display = 'none';
            document.getElementById('login-form').style.display = 'block';
        });
    </script>

    <!-- toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    {{-- Toaster Meassage --}}
    <script>
        @if (Session::has('message'))
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('<?= $error ?>');
            @endforeach
        @endif
    </script>
</body>

</html>
