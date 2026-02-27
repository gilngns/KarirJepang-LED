<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Karir Jepang LED</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-fav.png') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #eef1f4);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .landing-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .landing-card img {
            width: 130px;
            margin-bottom: 25px;
        }

        .btn-primary {
            background-color: #dc3545;
            border: none;
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #bb2d3b;
        }

        .subtitle {
            color: #6c757d;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="landing-card">

        <!-- Logo -->
        <img src="{{ asset('images/logo-w.jpg') }}" alt="Karir Jepang LED Logo">

        <!-- Title -->
        <h2 class="fw-bold mb-3">
            Karir Jepang LED
        </h2>

        <!-- Subtitle -->
        <p class="subtitle">
            Sistem Monitoring dan Manajemen Data Peserta
            serta Keberangkatan ke Jepang.
        </p>

        <!-- Button -->
        <a href="https://dailymonitoringkj.id/admin/login"
           class="btn btn-primary">
            Masuk
        </a>

    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>