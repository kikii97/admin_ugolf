@extends('index')

@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script> --}}

    <style>
        body {
            font-family: 'Kufam', sans-serif;
        }

        /* CSS untuk mengatur warna placeholder menjadi abu-abu */
        .form-control::placeholder {
            color: grey;
            opacity: 1;
            /* pastikan opacity 1 agar warna abu-abu tampil penuh */
        }

        #notification {
            position: fixed;
            top: 10px;
            right: 10px;
            width: 300px;
            padding: 15px;
            border-radius: 5px;
            z-index: 9999;
            display: none;
            text-align: center;
            justify-content: flex-start;
            /* Tetap di sebelah kiri */
            align-items: center;
            text-align: left;
            /* Teks tetap rata kiri */
            /* Hidden by default */
        }

        .input-group {
            position: relative;
        }

        .form-control {
            padding-left: 30px;
            /* Adjust padding to create space for the icon */
        }

        .bi {
            position: absolute;
            padding-left: 8px;
            top: 50%;
            left: 10px;
            /* Adjust position to the left side of the input */
            transform: translateY(-50%);
            font-size: 1rem;
            opacity: 0.7;
            /* Optional: make the icon a little faded */
        }

        .custom-hr {
            margin-top: 50px;
            /* Atur jarak atas */
            margin-bottom: 20px;
            /* Atur jarak bawah */
        }

        .card-header {
            background: linear-gradient(45deg, #78296D, #D058B9);
            color: white;
            padding: 10px;
            /* Reduced padding */
            border-top-left-radius: 30px;
            /* Increased smooth rounded corners for the header */
            border-top-right-radius: 30px;
            /* Increased smooth rounded corners for the header */
            text-align: center;
        }

        .card-header h4 {
            margin: 0;
            font-weight: bold;
            font-size: 1.25rem;
            /* Slightly smaller font */
            letter-spacing: 0.5px;
        }

        @media (max-width: 767px) {

            /* Adjustments for small screens */
            .card {
                width: 100% !important;
            }
        }
    </style>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- Bread crumb -->
    <div class="page-breadcrumb" style="margin-bottom: 20px;">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 style="font-family: 'Kufam', sans-serif;"
                    class="page-title text-truncate text-dark font-weight-medium mb-1">Profile User</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-lg-8 col-12 mx-auto px-4" style="padding-bottom: 1.5rem !important;">
        <div class="card h-100" style="margin-bottom: 0px;">
            <div class="card-header" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h5 style="margin-bottom: 0px; font-size: 19px;">Edit Profile</h5>
            </div>
            <div class="card-body">
                <div class="container mt-3">

                    <!-- Notification Element -->
                    <div id="notification" class="alert" style="display: none;">
                        <strong id="notificationTitle">Notification</strong>
                        <p id="notificationMessage">Not data changed.</p>
                    </div>

                    <script>
                        // Function untuk menampilkan notifikasi
                        function showNotification(type, message) {
                            let notificationTitle = '';
                            let notificationClass = '';

                            //  Mengatur judul dan kelas berdasarkan tipe notifikasi
                            switch (type) {
                                case 'success':
                                    notificationTitle = 'Success!';
                                    notificationClass = 'alert-success';
                                    break;
                                case 'error':
                                    notificationTitle = 'Error!';
                                    notificationClass = 'alert-danger';
                                    break;
                                default:
                                    notificationTitle = 'Info';
                                    notificationClass = 'alert-warning';
                            }

                            // mengatur konten notifikasi
                            $('#notificationTitle').text(notificationTitle);
                            $('#notificationMessage').text(message);
                            $('#notification').removeClass('alert-success alert-danger alert-warning').addClass(notificationClass);

                            // menampilkan notifikasi
                            $('#notification').fadeIn();

                            // menyembunyikan notifikasi setelah 3 detik
                            setTimeout(function() {
                                $('#notification').fadeOut();
                            }, 3000);
                        }
                    </script>

                    <!-- Edit Foto Form -->
                    <div class="text-center mb-4" style="margin-top: -20px;">
                        <div class="d-inline-block position-relative">
                            @if (isset($user['photo']) && $user['photo'])
                                <!-- Jika pengguna memiliki foto profil -->
                                <img id="previewPhoto" class="rounded-circle shadow-sm" style="width: 90px; height: 90px; border: 1px solid #ac2daa; padding: 3px;" alt="Profile Photo" src="{{ session('photo') ? (($apiUrl = rtrim(env('API_URL'), '/api')) ? $apiUrl . '/assets/photo_profile/' . session('photo') : 'default_photo_url_here') : 'default_photo_url_here' }}">
                            @else
                                <!-- Jika pengguna tidak memiliki foto profil -->
                                <a id="defaultPhoto" style="display: flex" class="nav-link dropdown-toggle align-items-center" href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle" style="font-size: 80px; color: #ac2daa; border: 2px solid #ac2daa; padding: 2px; border-radius: 50%;"></i>
                                </a>
                                <img id="previewPhoto" class="rounded-circle shadow-sm" style="display:none;width: 90px; height: 90px; border: 1px solid #ac2daa; padding: 3px;" alt="Profile Photo" src="">
                            @endif

                        </div>

                        <div class="mt-3 text-center">
                            <label for="profile_photo" class="btn btn-primary"
                                style="border-radius: 90px; background-color: purple; border: none; font-size: 14px;">
                                Upload Foto
                            </label>
                            <input type="file" class="form-control d-none" id="profile_photo" name="profile_photo"
                                accept="image/*">
                        </div>
                    </div>

                    <!-- Modal Konfirmasi Upload -->
                    <div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-labelledby="uploadPhotoModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="border-radius: 15px; margin: auto; max-width: 450px;">
                                <div class="modal-header">
                                    <h5 style="font-weight: 600;" class="modal-title" id="uploadPhotoModalLabel">Upload Foto
                                        Profil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div
                                    class="modal-body text-center d-flex flex-column justify-content-center align-items-center">
                                    <img id="modalPreviewPhoto" class="rounded-circle border mb-3" alt="Preview Photo"
                                        style="width: 120px; height: 120px;">
                                    <p>Apakah Anda yakin ingin mengunggah foto ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="confirmUploadPhoto" class="btn btn-primary"
                                        style="border-radius: 5px; background-color: purple; border: none;">
                                        Ya, Unggah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Preview Foto dan Tampilkan Modal
                        document.getElementById('profile_photo').addEventListener('change', function(e) {
                            const file = e.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(event) {
                                    if (document.getElementById('defaultPhoto')) {
                                        document.getElementById('defaultPhoto').style.display = 'none';
                                    }
                                    document.getElementById('previewPhoto').style.display = 'block';
                                    document.getElementById('previewPhoto').src = event.target.result;
                                    document.getElementById('modalPreviewPhoto').src = event.target.result;
                                    const modal = new bootstrap.Modal(document.getElementById('uploadPhotoModal'));
                                    modal.show();
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        // Proses Upload Foto
                        document.getElementById('confirmUploadPhoto').addEventListener('click', function() {
                            const formData = new FormData();
                            const photo = document.getElementById('profile_photo').files[0];
                            formData.append('photo', photo);

                            const confirmUploadButton = document.getElementById('confirmUploadPhoto');
                            confirmUploadButton.innerHTML =
                                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                            confirmUploadButton.disabled = true;

                            fetch('{{ route('profile.photo.update') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        showNotification('success', 'Foto profil berhasil diunggah.');
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1000);
                                    } else {
                                        showNotification('error', 'Terjadi kesalahan saat mengunggah foto profil.');
                                    }
                                })
                                .catch(error => console.error('Error:', error))
                                .finally(() => {
                                    confirmUploadButton.innerHTML = 'Ya, Unggah';
                                    confirmUploadButton.disabled = false;
                                });
                        });
                    </script>

                    <!-- Profile Form -->
                    <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
                        @csrf
                        @method('PUT')

                        {{-- @if (session('success'))
                            <div class="alert alert-success" id="successNotification" style="border-radius: 10px;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" id="errorNotification">
                                {{ session('error') }}
                            </div>
                        @endif

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Get success and error notification elements
                                const successNotification = document.getElementById('successNotification');
                                const errorNotification = document.getElementById('errorNotification');

                                // Hide the success notification after 3 seconds if it exists
                                if (successNotification) {
                                    setTimeout(() => {
                                        successNotification.style.display = 'none';
                                    }, 3000); // Hide after 3 seconds
                                }

                                // Hide the error notification after 3 seconds if it exists
                                if (errorNotification) {
                                    setTimeout(() => {
                                        errorNotification.style.display = 'none';
                                    }, 3000); // Hide after 3 seconds
                                }
                            });
                        </script> --}}

                        <div class="row">
                            <!-- Name Field with Icon Inside -->
                            <div class="col-md-6 mb-3">
                                <label style="color: #7e7a7a;" for="name" class="form-label">Name</label>
                                <div class="input-group">
                                    <input type="text" style="border-radius: 6px;" class="form-control ps-5"
                                        name="name" value="{{ $user['name'] ?? NULL }}" required />
                                    <i class="bi bi-person position-absolute top-50 start-0 translate-middle-y ms-2"></i>
                                </div>
                            </div>

                            <!-- Email Field with Icon Inside -->
                            <div class="col-md-6 mb-3">
                                <label style="color: #7e7a7a;" for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="text" style="border-radius: 6px;"
                                        class="form-control ps-5 border-none focus:ring-0" name="email"
                                        value="{{ $user['email'] }}" required />
                                    <i class="bi bi-envelope position-absolute top-50 start-0 translate-middle-y ms-2"></i>
                                </div>
                            </div>
                        </div>

                        <hr style="border-color: #737373;">

                        <h5 style="color: #474747">Change Password</h5>
                        <p class="text-muted" style="font-size: 13px; margin-top: -8px; margin-bottom: 30px;">Leave blank
                            if you don't want to change the password.</p>

                        <div class="row" style="margin-top: -20px;">
                            <!-- Password Field -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label" style="color: #7e7a7a;">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control ps-5" id="password" name="password"
                                        placeholder="New password" style="border-radius: 6px;" />
                                    <svg style="padding-left: 8px;"
                                        class="position-absolute top-50 start-0 translate-middle-y ms-2"
                                        xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="#636363"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M216.57,39.43A80,80,0,0,0,83.91,120.78L28.69,176A15.86,15.86,0,0,0,24,187.31V216a16,16,0,0,0,16,16H72a8,8,0,0,0,8-8V208H96a8,8,0,0,0,8-8V184h16a8,8,0,0,0,5.66-2.34l9.56-9.57A79.73,79.73,0,0,0,160,176h.1A80,80,0,0,0,216.57,39.43ZM224,98.1c-1.09,34.09-29.75,61.86-63.89,61.9H160a63.7,63.7,0,0,1-23.65-4.51,8,8,0,0,0-8.84,1.68L116.69,168H96a8,8,0,0,0-8,8v16H72a8,8,0,0,0-8,8v16H40V187.31l58.83-58.82a8,8,0,0,0,1.68-8.84A63.72,63.72,0,0,1,96,95.92c0-34.14,27.81-62.8,61.9-63.89A64,64,0,0,1,224,98.1ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z">
                                        </path>
                                    </svg>
                                </div>
                                <div id="passwordError" class="text-danger mt-1" style="font-size: 12px; display: none;">
                                </div>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label" style="color: #7e7a7a;">Confirm New
                                    Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control ps-5 border-none focus:ring-0"
                                        style="border-radius: 6px;" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm new password" />
                                    <svg style="padding-left: 8px;"
                                        class="position-absolute top-50 start-0 translate-middle-y ms-2"
                                        xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="#636363"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M216.57,39.43A80,80,0,0,0,83.91,120.78L28.69,176A15.86,15.86,0,0,0,24,187.31V216a16,16,0,0,0,16,16H72a8,8,0,0,0,8-8V208H96a8,8,0,0,0,8-8V184h16a8,8,0,0,0,5.66-2.34l9.56-9.57A79.73,79.73,0,0,0,160,176h.1A80,80,0,0,0,216.57,39.43ZM224,98.1c-1.09,34.09-29.75,61.86-63.89,61.9H160a63.7,63.7,0,0,1-23.65-4.51,8,8,0,0,0-8.84,1.68L116.69,168H96a8,8,0,0,0-8,8v16H72a8,8,0,0,0-8,8v16H40V187.31l58.83-58.82a8,8,0,0,0,1.68-8.84A63.72,63.72,0,0,1,96,95.92c0-34.14,27.81-62.8,61.9-63.89A64,64,0,0,1,224,98.1ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z">
                                        </path>
                                    </svg>
                                </div>
                                <div id="passwordConfirmationError" class="text-danger mt-1"
                                    style="font-size: 12px; display: none;"></div>
                            </div>
                        </div>

                        <!-- Submit Button with loading spinner -->
                        <button type="submit" class="btn btn-primary mt-3" id="submitButton"
                            style="border-radius: 5px; background-color: purple; border: none;">
                            <span id="loadingIcon" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true" style="display: none;"></span> Edit Profil
                        </button>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.getElementById('profileForm');
                            const submitButton = document.getElementById('submitButton');
                            const loadingIcon = document.getElementById('loadingIcon');
                            const nameInput = document.getElementsByName('name')[0];
                            const emailInput = document.getElementsByName('email')[0];
                            const passwordInput = document.getElementById('password');
                            const confirmPasswordInput = document.getElementById('password_confirmation');
                            const notification = document.getElementById('notification');
                            const originalName = nameInput.value;
                            const originalEmail = emailInput.value;
                            const originalPassword = passwordInput.value;
                            const originalConfirmPassword = confirmPasswordInput.value;

                            // // Add event listeners to validate password
                            // passwordInput.addEventListener('input', validatePassword);
                            // confirmPasswordInput.addEventListener('input', validatePassword);

                            // function validatePassword() {
                            //     const password = passwordInput.value;
                            //     const confirmPassword = confirmPasswordInput.value;

                            //     // Password length check
                            //     if (password.length < 8 && password.length > 0) {
                            //         document.getElementById('passwordError').textContent =
                            //             'Password must be at least 8 characters.';
                            //         document.getElementById('passwordError').style.display = 'block';
                            //     } else {
                            //         document.getElementById('passwordError').style.display = 'none';
                            //     }

                            //     // Confirm password match check
                            //     if (confirmPassword && password !== confirmPassword) {
                            //         document.getElementById('passwordConfirmationError').textContent = 'Passwords do not match.';
                            //         document.getElementById('passwordConfirmationError').style.display = 'block';
                            //     } else {
                            //         document.getElementById('passwordConfirmationError').style.display = 'none';
                            //     }
                            // }

                            // // Show loading spinner and disable button if data is changed
                            // form.addEventListener('submit', function(e) {
                            //     const name = nameInput.value;
                            //     const email = emailInput.value;
                            //     const password = passwordInput.value;
                            //     const confirmPassword = confirmPasswordInput.value;

                            //     // Check if any data has changed
                            //     if (
                            //         name === originalName &&
                            //         email === originalEmail &&
                            //         password === originalPassword &&
                            //         confirmPassword === originalConfirmPassword
                            //     ) {
                            //         e.preventDefault(); // Prevent form submission
                            //         showNotification('No data changed.', 'info');
                            //     } else if (name === '' || email === '' || password === '' || confirmPassword === '') {
                            //         e.preventDefault(); // Prevent form submission
                            //         showNotification('Please fill in all fields before submitting.', 'warning');
                            //     } else {
                            //         // Show loading spinner, hide button text, and disable the submit button
                            //         submitButton.disabled = true;
                            //         submitButton.innerHTML =
                            //             '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'; // Only show spinner
                            //         loadingIcon.style.display = 'inline-block'; // Show the spinner
                            //     }
                            // });

                            function showNotification(message, type = 'info') {
                                // Show notification with message
                                notification.textContent = message;
                                notification.classList.remove('alert-success', 'alert-danger', 'alert-info',
                                'alert-warning'); // Remove all previous classes
                                notification.classList.add(
                                `alert-${type}`); // Add class based on type (info, success, error, warning)
                                notification.style.display = 'block';

                                // Ensure the notification disappears after 3 seconds
                                clearTimeout(notification.timer); // Clear any previous timer
                                notification.timer = setTimeout(() => {
                                    notification.style.display = 'none';
                                }, 3000);
                            }

                            // Check for session messages and show them as notifications
                            const successMessage = '{{ session('success') }}';
                            const errorMessage = '{{ session('error') }}';

                            if (successMessage) {
                                showNotification(successMessage, 'success');
                            }

                            if (errorMessage) {
                                showNotification(errorMessage, 'danger');
                            }

                            // Simulate success after form submission (e.g., after password is updated)
                            // You can replace this with a real success condition based on your form submission logic.
                            if (sessionStorage.getItem('passwordUpdated')) {
                                showNotification('Password successfully updated.', 'success');
                                sessionStorage.removeItem('passwordUpdated'); // Remove success flag after showing
                            }
                        });
                    </script>

                    {{-- <script>
                        // Ambil elemen input password dan konfirmasi password
                        const passwordField = document.getElementById('password');
                        const passwordConfirmationField = document.getElementById('password_confirmation');
                        const passwordError = document.getElementById('passwordError');
                        const passwordConfirmationError = document.getElementById('passwordConfirmationError');

                        // Fungsi untuk validasi form
                        function validatePassword() {
                            // Reset error messages
                            passwordError.style.display = 'none';
                            passwordConfirmationError.style.display = 'none';

                            let isValid = true;

                            // Validasi panjang password
                            if (passwordField.value.length < 8) {
                                passwordError.style.display = 'block';
                                passwordError.textContent = 'Password tidak boleh kurang dari 8 karakter';
                                isValid = false;
                            }

                            if (passwordField.value !== '' && passwordConfirmationField.value !== '') {
                                if (passwordField.value !== passwordConfirmationField.value) {
                                    passwordConfirmationError.style.display = 'block';
                                    passwordConfirmationError.textContent = 'Password tidak sama';
                                    isValid = false;
                                }
                            }

                            return isValid;
                        }

                        // Event listener untuk memvalidasi saat password atau konfirmasi password berubah
                        passwordField.addEventListener('input', validatePassword);
                        passwordConfirmationField.addEventListener('input', validatePassword);
                    </script> --}}

                    <script>
                        // Ambil elemen input password dan konfirmasi password
                        const passwordField = document.getElementById('password');
                        const passwordConfirmationField = document.getElementById('password_confirmation');
                        const passwordError = document.getElementById('passwordError');
                        const passwordConfirmationError = document.getElementById('passwordConfirmationError');
                        const submitButton = document.getElementById('submitButton'); // Pastikan ID tombol benar
                    
                        // Fungsi untuk validasi form
                        function validatePassword() {
                            // Reset error messages
                            passwordError.style.display = 'none';
                            passwordConfirmationError.style.display = 'none';
                    
                            let isValid = true;
                    
                            // Validasi panjang password
                            if (passwordField.value.length > 0 && passwordField.value.length < 8) {
                                passwordError.style.display = 'block';
                                passwordError.textContent = 'Password tidak boleh kurang dari 8 karakter';
                                isValid = false;
                            }
                    
                            // Validasi kecocokan password
                            if (passwordField.value !== '' && passwordConfirmationField.value !== '') {
                                if (passwordField.value !== passwordConfirmationField.value) {
                                    passwordConfirmationError.style.display = 'block';
                                    passwordConfirmationError.textContent = 'Password tidak sama';
                                    isValid = false;
                                }
                            }
                    
                            // Atur status tombol submit
                            submitButton.disabled = 
                                (!isValid) || 
                                (passwordField.value !== '' && passwordConfirmationField.value === '') || 
                                (passwordField.value === '' && passwordConfirmationField.value !== '');
                    
                            return isValid;
                        }
                    
                        // Event listener untuk memvalidasi saat password atau konfirmasi password berubah
                        passwordField.addEventListener('input', validatePassword);
                        passwordConfirmationField.addEventListener('input', validatePassword);
                    
                        // Tambahkan validasi tambahan pada saat form dikirimkan (opsional jika diperlukan)
                        const form = document.querySelector('form'); // Pastikan form ini sesuai
                        form.addEventListener('submit', function (e) {
                            if (!validatePassword()) {
                                e.preventDefault(); // Batalkan pengiriman jika tidak valid
                            }
                        });
                    </script>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Ambil elemen-elemen form dan notifikasi
                            const profileForm = document.getElementById('profileForm');
                            const successNotification = document.getElementById('successNotification');
                            const errorNotification = document.getElementById('errorNotification');
                            const submitButton = document.getElementById('submitButton');
                            const loadingIcon = document.getElementById('loadingIcon');
                            const passwordField = document.getElementById('password');
                            const passwordConfirmationField = document.getElementById('password_confirmation');

                            // Nilai awal dari name, email, password untuk pengecekan
                            const initialName = "{{ $user['name'] }}";
                            const initialEmail = "{{ $user['email'] }}";

                            // Fungsi untuk mengecek apakah ada perubahan pada form
                            function checkChanges() {
                                const name = document.querySelector('input[name="name"]').value;
                                const email = document.querySelector('input[name="email"]').value;
                                const password = passwordField.value;
                                const passwordConfirmation = passwordConfirmationField.value;

                                // Cek apakah ada perubahan pada name, email, atau password
                                if (name === initialName && email === initialEmail && password === "" && passwordConfirmation ===
                                    "") {
                                    return false; // Tidak ada perubahan
                                }
                                return true; // Ada perubahan
                            }

                            // Event listener untuk form submit
                            profileForm.addEventListener('submit', function(event) {
                                // Cek apakah ada perubahan
                                if (!checkChanges()) {
                                    // Hentikan pengiriman form
                                    event.preventDefault();

                                    // Tampilkan notifikasi bahwa tidak ada data yang diubah
                                    if (!errorNotification) {
                                        const noChangeNotification = document.createElement('div');
                                        noChangeNotification.classList.add('alert', 'alert-warning');
                                        noChangeNotification.textContent = 'Tidak ada data yang diubah';
                                        noChangeNotification.style.borderRadius = '10px';
                                        profileForm.insertBefore(noChangeNotification, profileForm.firstChild);

                                        // Sembunyikan notifikasi setelah 3 detik
                                        setTimeout(() => {
                                            noChangeNotification.style.display = 'none';
                                        }, 3000);
                                    }
                                } else {
                                    // Tampilkan loading spinner
                                    submitButton.disabled = 'none';
                                    loadingIcon.style.display = 'inline-block';
                                }
                            });

                            @if (session('success'))
                                showNotification('success', '{{ session('success') }}');
                            @endif

                            @if ($errors->any())
                                let errorMessage = '';
                                @foreach ($errors->all() as $error)
                                    errorMessage += '{{ is_array($error) ? implode(', ', $error) : $error }}' + '\n';
                                @endforeach
                                showNotification('error', errorMessage.trim());
                            @endif
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
