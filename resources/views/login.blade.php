<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UGOLF</title>
    <link rel="stylesheet" href="../bootstrap.alpha/alpha.bootstrap.min.css">
    <link href="../dist/css/icons/font-awesome/css/fontawesome-all.css" rel="stylesheet">
    <link href="../dist/css/fonts/Family-Kufam.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

    <style>
        body {
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .alert-danger {
            color: #ffffff;
            background-color: #ba0e6e;
            font-size: 15px;
            border-radius: 10px;
            border: none;
        }
    </style>
</head>

<body oncontextmenu='return false' class='snippet-body'>
    <div class="container">
        <!-- SVG element positioned in the top right corner -->
        <img class="svg-right" src="../assets/images/right.svg" alt="Shape" />

        <!-- SVG element positioned in the bottom left corner -->
        <img class="svg-left" src="../assets/images/left.svg" alt="Shape" />

        <div class="wrapper">
            <h1 style="font-family: 'Kufam', sans-serif;">UGOLF</h1>

            @if ($errors->has('error'))
                <div id="login-error-alert" class="alert alert-danger">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <form class="pt-3" action="{{ route('login') }}" method="POST">
                @csrf <!-- Add CSRF token for security -->
                <div class="form-group py-2">
                    <div class="input-field">
                        <span class="far fa-envelope p-2"></span>
                        <input style="background: transparent;" class="input-form" type="text" name="email"
                            placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group py-1 pb-2">
                    <div class="input-field">
                        <span class="fas fa-lock p-2"></span>
                        <input class="input-form" type="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <!-- Remember me and Forgot Password -->
                <button type="submit" class="btn btn-block text-center my-3">
                    Log in
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('login-error-alert');
            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.transition = 'opacity 0.5s';
                    alertBox.style.opacity = '0';
                    setTimeout(() => alertBox.remove(), 500); // Hapus elemen setelah transisi
                }, 3000); // 3000 ms = 3 detik
            }
        });
    </script>
</body>

</html>
