@extends('index')

@section('content')
<style>
    /* Style for purple gradient button */
    .btn-gradient-purple {
        background: linear-gradient(45deg, #78296D, #D058B9);
        color: white;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-gradient-purple:hover {
        background: linear-gradient(45deg, #6c2563, #a1448f);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        color: white;
    }

    /* Style for the Cancel button */
    .btn-secondary {
        background-color: red; /* Red background */
        color: white;
        border: none;
        border-radius: 50px; /* Same border radius as the Update button */
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: darkred; /* Darker red on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    /* Style for action button */
    .btn-action {
        background: none;
        border: none;
        padding: 10px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .btn-action:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Style for icons */
    .iconify {
        font-size: 22px;
        color: #6c2563;
    }

    .iconify:hover {
        color: #D058B9;
    }

   /* Notification styling */
   #successNotification {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 300px;
        padding: 15px;
        border-radius: 5px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        font-weight: bold;
        text-align: center;
        z-index: 9999;
        display: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Compact card header styling */
    .card {
        border-radius: 30px; /* Increased rounding for the card */
    }

    .card-header {
        background: linear-gradient(45deg, #78296D, #D058B9);
        color: white;
        padding: 10px; /* Reduced padding */
        border-top-left-radius: 30px; /* Increased smooth rounded corners for the header */
        border-top-right-radius: 30px; /* Increased smooth rounded corners for the header */
        text-align: center;
    }

    .card-header h4 {
        margin: 0;
        font-weight: bold;
        font-size: 1.25rem; /* Slightly smaller font */
        letter-spacing: 0.5px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        font-weight: bold;
        text-align: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    <!-- Profile update form -->
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        
                        <!-- Name field -->
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" 
                                       value="{{ old('name', $user->name ?? '') }}" 
                                       required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email field -->
                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" 
                                       value="{{ old('email', $user->email ?? '') }}" 
                                       required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password field -->
                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" 
                                       autocomplete="new-password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password field -->
                        <div class="form-group row mb-3">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" 
                                       class="form-control" 
                                       name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- Submit and Cancel buttons -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-gradient-purple">Update Profile</button>
                                <a href="{{ route('profile.update') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for notification fade out -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successNotification = document.getElementById('successNotification');
        @if (session('success'))
            successNotification.style.display = 'block';
            setTimeout(function() {
                successNotification.style.transition = 'opacity 0.5s ease-out';
                successNotification.style.opacity = '0';
                setTimeout(function() {
                    successNotification.style.display = 'none';
                }, 500);
            }, 3000); // alert fades out after 3 seconds
        @endif
    });
</script>
@endsection
