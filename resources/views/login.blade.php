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

            <!-- Alert for login error -->
            @if ($errors->has('loginError'))
                <div class="alert alert-danger">
                    {{ $errors->first('loginError') }}
                </div>
            @endif

            <form class="pt-3" action="{{ route('login') }}" method="POST">
                @csrf <!-- Add CSRF token for security -->
                <div class="form-group py-2">
                    <div class="input-field">
                        <span class="far fa-user p-2"></span>
                        <input style="background: transparent;" class="input-form" type="text" name="email"
                            placeholder="Username" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group py-1 pb-2">
                    <div class="input-field">
                        <span class="fas fa-lock p-2"></span>
                        <input class="input-form" type="password" name="password" placeholder="Password"
                            required>
                    </div>
                </div>
                <!-- Remember me and Forgot Password -->
                <button type="submit" class="btn btn-block text-center my-3">
                    Log in
                </button>
            </form>
        </div>
    </div>
</body>

</html>
