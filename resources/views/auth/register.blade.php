<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Akun - Soegitos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-top: 120px;
        }

        .logo-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: start;
            padding: 15px 30px;
            color: white;
        }

        .logo-top video {
            height: 64px;
            width: 64px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-text span.company-name {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .logo-text small {
            font-size: 0.9rem;
            line-height: 1.2;
            color: #f0f0f0;
        }

        .register-box {
            background: #ffffff;
            padding: 2rem 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 480px;
        }

        .register-box img.logo-login {
            width: 100px;
            margin-bottom: 20px;
        }

        .title-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .title-box img.user-icon {
            width: 32px;
            height: 32px;
        }

        .title-box span {
            font-size: 1.4rem;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 1rem;
        }

        .input-group-text {
            cursor: pointer;
        }

        .btn-primary {
            width: 100%;
            border-radius: 8px;
            background-color: #1e3c72;
            border: none;
            font-size: 1rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #16325c;
        }

        .footer-text {
            margin-top: 20px;
            font-size: 0.85rem;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="logo-top">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('assets/vidio/Vid1SSY.mp4') }}" type="video/mp4" />
            Browser Anda tidak mendukung tag video.
        </video>
        <div class="logo-text">
            <span class="company-name">PT. SOEGITOS SRI YOEWANTI</span>
            <small>SMART SOLUTION FOR YOUR TECHNOLOGY AND SOLUTION FOR THE NEEDS OF ELECTRONICS</small>
        </div>
    </div>

    <div class="register-box">
        <img src="{{ asset('assets/logo/ssy.jpg') }}" alt="Logo" class="logo-login" />

        <div class="title-box">
            <img src="{{ asset('assets/logo/user.png') }}" alt="User Icon" class="user-icon" />
            <span>Registrasi Akun</span>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" class="form-control" placeholder="Nama lengkap" value="{{ old('name') }}"
                required autofocus>

            <input type="email" name="email" class="form-control" placeholder="Alamat Email" value="{{ old('email') }}"
                required>

            <div class="input-group mb-3">
                <input type="password" name="password" id="password" class="form-control m-auto" placeholder="Password"
                    required>
                <span class="input-group-text" onclick="togglePassword('password', this)">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control m-auto" placeholder="Konfirmasi Password" required>
                <span class="input-group-text" onclick="togglePassword('password_confirmation', this)">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>

            <button type="submit" class="btn btn-primary">Daftar</button>

            <p class="text-center mt-3">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </p>
        </form>

        <p class="footer-text">© 2025 Soegitos. All rights reserved.</p>
    </div>

    <!-- JS for show/hide password -->
    <script>
        function togglePassword(id, el) {
            const input = document.getElementById(id);
            const icon = el.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        }
    </script>

</body>

</html>