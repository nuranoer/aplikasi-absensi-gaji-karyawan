<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Absensi - Soegitos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
      box-sizing: border-box;
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

    .login-box {
      background: #ffffff;
      padding: 2rem 2.5rem;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      text-align: center;
      width: 100%;
      max-width: 420px;
    }

    .login-box img.logo-login {
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

    @media (max-width: 576px) {
      .logo-top video {
        height: 48px;
        width: 48px;
      }

      .logo-text span.company-name {
        font-size: 1.2rem;
      }

      .logo-text small {
        font-size: 0.75rem;
      }

      .title-box span {
        font-size: 1.2rem;
      }

      .title-box img.user-icon {
        width: 28px;
        height: 28px;
      }
    }
  </style>
</head>
<body>

  <!-- Header logo lebar penuh (Video + Nama Perusahaan + Slogan) -->
  <div class="logo-top">
    <video autoplay muted loop playsinline>
      <source src="{{ asset('assets/vidio/Vid1SSY.mp4') }}" type="video/mp4">
      Browser Anda tidak mendukung tag video.
    </video>
    <div class="logo-text">
      <span class="company-name">PT. SOEGITOS SRI YOEWANTI</span>
      <small>SMART SOLUTION FOR YOUR TECHNOLOGY AND SOLUTION FOR THE NEEDS OF ELECTRONICS</small>
    </div>
  </div>

  <!-- Kotak login -->
  <div class="login-box">
    <img src="{{ asset('assets/logo/ssy.jpg') }}" alt="Logo" class="logo-login">

    <!-- Judul dengan ikon user -->
    <div class="title-box">
      <img src="{{ asset('assets/logo/user.png') }}" alt="User Icon" class="user-icon">
      <span>Sistem Absensi Digital</span>
    </div>

    <form action="/login/karyawan" method="POST">
      <input type="text" name="username" class="form-control" placeholder="Username" required>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p class="footer-text">© 2025 Soegitos. All rights reserved.</p>
  </div>

</body>
</html>