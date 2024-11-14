<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LegalTime</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #343a40;
            height: 100vh;
            padding: 1rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar .nav-link {
            color: #ffffff;
            margin-bottom: 1rem;
        }
        .sidebar .nav-link:hover {
            color: #adb5bd;
        }
        .sidebar .nav-link.active {
            font-weight: bold;
            color: #ffc107;
        }
        .content {
            margin-left: 220px;
            padding: 2rem;
        }
        .form-control {
            border-radius: 30px;
        }
        .btn-outline-success {
            border-radius: 30px;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1rem 0;
            position: relative;
            display: none;
        }
        .user-section {
            margin-top: auto;
            padding-bottom: 1rem;
        }
    </style>
</head>
<body>

    @if (!Request::is('login') && !Request::is('register'))
        <div class="sidebar">
            <div>
                <a class="navbar-brand text-white d-block mb-4" href="#">LegalTime</a>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
            </div>

            <div class="user-section">
                @if (isset($usuario))
                    <a href="{{ route('usuario.index') }}" class="nav-link">
                        <i class="fas fa-solid fa-gear"></i>
                    </a>
                @else
                    <a href="{{ route('login.index') }}" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                @endif
            </div>
        </div>
    @endif

    <div class="content">
        <div class="container mt-5">
            @yield('content')
        </div>
    </div>

    <footer id="footer">
        <p>&copy; 2024 LegalTime - Todos direitos reservados</p>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const scrollable = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = window.scrollY;

            if (Math.ceil(scrolled) >= scrollable) {
                document.getElementById('footer').style.display = 'block';
            }
        });
    </script>

</body>
</html>
