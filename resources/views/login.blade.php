<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UGOLF</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <!-- Google Fonts Kufam -->
    <link href="https://fonts.googleapis.com/css2?family=Kufam:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box
        }

        body {
            background-color: #eee;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            max-width: 500px;
            border-radius: 10px;
            margin: 50px auto;
            padding: 30px 40px;
        }

        .h2 {
            font-family: 'Kufam', sans-serif;
            font-size: 3.5rem;
            font-weight: bold;
            color: #400485;
            font-style: italic
        }

        .h4 {
            font-family: 'Poppins', sans-serif
        }

        .input-field {
            border-radius: 5px;
            padding: 5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 1px solid #400485;
            color: #400485
        }

        .input-field:hover {
            color: #7b4ca0;
            border: 1px solid #7b4ca0
        }

        input {
            border: none;
            outline: none;
            box-shadow: none;
            width: 100%;
            padding: 0px 2px;
            font-family: 'Poppins', sans-serif
        }

        .fa-eye-slash.btn {
            border: none;
            outline: none;
            box-shadow: none
        }

        a {
            text-decoration: none;
            color: #400485;
            font-weight: 700
        }

        a:hover {
            text-decoration: none;
            color: #7b4ca0
        }

        .option {
            position: relative;
            padding-left: 30px;
            cursor: pointer
        }

        .option label.text-muted {
            display: block;
            cursor: pointer
        }

        .option input {
            display: none
        }

        .checkmark {
            position: absolute;
            top: 3px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 50%;
            cursor: pointer
        }

        .option input:checked~.checkmark:after {
            display: block
        }

        .option .checkmark:after {
            content: "";
            width: 13px;
            height: 13px;
            display: block;
            background: #400485;
            position: absolute;
            top: 48%;
            left: 53%;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 300ms ease-in-out 0s
        }

        .option input[type="radio"]:checked~.checkmark {
            background: #fff;
            transition: 300ms ease-in-out 0s;
            border: 1px solid #400485
        }

        .option input[type="radio"]:checked~.checkmark:after {
            transform: translate(-50%, -50%) scale(1)
        }

        .btn.btn-block {
            border-radius: 20px;
            background-color: #400485;
            color: #fff
        }

        .btn.btn-block:hover {
            background-color: #55268be0
        }

        @media(max-width: 575px) {
            .wrapper {
                margin: 10px
            }
        }

        @media(max-width:424px) {
            .wrapper {
                padding: 30px 10px;
                margin: 5px
            }

            .option {
                position: relative;
                padding-left: 22px
            }

            .option label.text-muted {
                font-size: 0.95rem
            }

            .checkmark {
                position: absolute;
                top: 2px
            }

            .option .checkmark:after {
                top: 50%
            }

            #forgot {
                font-size: 0.95rem
            }
        }
    </style>
</head>

<body oncontextmenu='return false' class='snippet-body'>
    <div class="container">
        <!-- SVG element positioned in the top right corner -->
        <svg class="svg-right" width="745" height="897" viewBox="0 0 645 797" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M872.95 337.805C836.732 419.41 716.401 399.793 632.857 431.28C559.407 458.962 492.256 539.027 419.923 508.544C347.806 478.151 355.813 375.444 327.369 302.537C301.66 236.638 250.433 177.983 263.866 108.534C279.208 29.2107 327.29 -47.4302 401.317 -79.7954C474.745 -111.899 558.234 -85.7305 630.899 -51.9363C697.375 -21.0203 742.581 34.6241 781.26 96.9041C828.384 172.781 909.184 256.165 872.95 337.805Z"
                fill="url(#paint0_linear_99_769)" />
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M983.518 357.791C923.863 424.216 815.477 368.386 726.293 372.523C647.883 376.161 559.283 431.565 499.905 380.228C440.705 329.043 480.049 233.834 475.519 155.705C471.425 85.0874 440.824 13.4761 475.054 -48.4266C514.15 -119.13 583.557 -177.168 663.962 -185.082C743.715 -192.931 815.037 -142.251 873.708 -87.662C927.382 -37.722 953.186 29.1656 970.733 100.348C992.112 187.072 1043.2 291.338 983.518 357.791Z"
                fill="url(#paint1_linear_99_769)" />
            <defs>
                <linearGradient id="paint0_linear_99_769" x1="-58.999" y1="-532.5" x2="778.001" y2="342.5"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFE2FB" stop-opacity="0.2" />
                    <stop offset="1" stop-color="#7D2B71" />
                </linearGradient>
                <linearGradient id="paint1_linear_99_769" x1="1051.8" y1="235.046" x2="174.5" y2="-258"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFE2FB" stop-opacity="0.2" />
                    <stop offset="1" stop-color="#7D2B71" />
                </linearGradient>
            </defs>
        </svg>

        <!-- SVG element positioned in the bottom left corner -->
        <svg class="svg-left" width="845" height="797" viewBox="0 0 572 574" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M62.3372 100.316C148.59 77.2634 208.88 183.233 285.844 228.483C353.509 268.266 457.988 270.255 479.681 345.691C501.311 420.902 416.348 479.161 377.465 547.078C342.32 608.466 328.836 685.165 266.35 718.319C194.981 756.187 105.141 766.888 33.469 729.597C-37.6225 692.607 -69.6804 611.197 -89.0061 533.424C-106.686 462.274 -91.7636 392.152 -67.5792 322.942C-38.1148 238.622 -23.9537 123.379 62.3372 100.316Z"
                fill="url(#paint0_linear_99_766)" />
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M8.46476 1.71287C97.6203 6.43337 122.225 125.844 181.445 192.657C233.511 251.398 332.265 285.565 329.593 364.013C326.93 442.227 228.125 471.39 170.163 523.973C117.773 571.501 81.254 640.283 11.5828 652.512C-67.9937 666.479 -156.745 648.904 -213.391 591.295C-269.578 534.153 -274.919 446.822 -269.273 366.882C-264.108 293.751 -228.253 231.668 -183.871 173.315C-129.8 102.222 -80.73 -3.00971 8.46476 1.71287Z"
                fill="url(#paint1_linear_99_766)" />
            <defs>
                <linearGradient id="paint0_linear_99_766" x1="658.5" y1="506.5" x2="46.5" y2="-52"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFE2FB" stop-opacity="0.2" />
                    <stop offset="1" stop-color="#7D2B71" />
                </linearGradient>
                <linearGradient id="paint1_linear_99_766" x1="-129.941" y1="25.6438" x2="213.5" y2="571.5"
                    gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFE2FB" stop-opacity="0.2" />
                    <stop offset="1" stop-color="#7D2B71" />
                </linearGradient>
            </defs>
        </svg>
        <h1 style="font-family: 'Kufam', sans-serif;">UGOLF</h1>
        {{-- <a href="#" class="btn">
            <img src="assets/images/Ticket.png" alt="Ticket Icon" width="25">
            BELI TIKET
        </a> --}}
        <div class="">
            {{-- <div class="h2 text-center">UGOLF</div> --}}
            <form class="pt-3">
                <div class="form-group py-2">
                    <div class="input-field"> <span class="far fa-user p-2"></span> <input type="text"
                            placeholder="Username or Email Address" required class=""> </div>
                </div>
                <div class="form-group py-1 pb-2">
                    <div class="input-field"> <span class="fas fa-lock p-2"></span> <input type="text"
                            placeholder="Enter your Password" required class=""> <button
                            class="btn bg-white text-muted">
                            <span class="far fa-eye-slash"></span> </button> </div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="remember"> <label class="option text-muted"> Remember me <input type="radio"
                                name="radio">
                            <span class="checkmark"></span> </label> </div>
                    <div class="ml-auto"> <a href="#" id="forgot">Forgot Password?</a> </div>
                </div> <button class="btn btn-block text-center my-3">Log in</button>
                <div class="text-center pt-3 text-muted">Not a member? <a href="#">Sign up</a></div>
            </form>
        </div>
    </div>
</body>

<script type='text/javascript' src=''></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'>
</script>
<script type='text/javascript'></script>
