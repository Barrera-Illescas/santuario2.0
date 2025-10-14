<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Santuario | Administración</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/styles2.css') }}" rel="stylesheet"> --}}

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        .page-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar-wrapper {
            width: 260px;
            background-color: #e3f2fd;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: margin-left 0.3s ease;
            position: relative;
        }

        .sidebar-wrapper.hidden {
            margin-left: -260px;
        }

        .sidebar-content {
            padding: 20px;
        }

        .sidebar-brand {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
            color: #0d6efd;
            margin-bottom: 20px;
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .user-pic img {
            width: 150px;
            /* border-radius: 50%; */
            margin-bottom: 10px;
        }

        .user-info {
            font-size: 14px;
            color: #333;
        }

        .user-info .user-name {
            font-weight: bold;
            color: #0d6efd;
        }

        .user-info .user-role {
            font-size: 13px;
            color: #6c757d;
        }

        .user-info .user-status {
            font-size: 12px;
            color: green;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 6px;
            color: #333;
            text-decoration: none;
            transition: background 0.2s;
        }

        .sidebar-menu a:hover {
            background-color: #d0e7ff;
            color: #0d6efd;
        }

        .sidebar-menu i {
            margin-right: 10px;
        }

        .page-content {
            flex-grow: 1;
            background-color: #ffffff;
            padding: 10px 10px;
        }

        .header {
            background-color: #0d6efd;
            color: white;
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .toggle-btn {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 4px 8px;
            border-radius: 50%;
            cursor: pointer;
        }

        .sidebar-menu a.active {
            background-color: #d0e7ff;
            color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <span>Santuario</span>
                    <button class="toggle-btn" onclick="toggleSidebar()" id="sidebarToggle">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="sidebar-header ">
                    <div class="user-pic justify-content-center">
                            <li><a href="#" onclick="selectComponent('dashboardSoporte', this)">
                                <img src="./assets/img/logo.png" alt="User picture"></a>
                            </li>
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span><br>
                        <span class="user-role">Administrador</span><br>
                        <span class="user-status"><i class="fa fa-circle"></i> Online</span>
                    </div>
                </div>
                <hr />
                <div class="sidebar-menu">
                    <ul id="menu-items">
                        <li><a href="#" onclick="selectComponent('Animales', this)"><i class="fa fa-paw"></i>
                                Animales</a></li>
                        <li><a href="#" onclick="selectComponent('Capacidad', this)"><i class="fa fa-map-marker" ></i>
                                Capacidad</a></li>
                        <li><a href="#" onclick="selectComponent('Donantes', this)"><i class="fa fa-users"></i>
                                Donantes</a></li>
                        <li><a href="#" onclick="selectComponent('Donaciones', this)"><i class="fa fa-gift"></i>
                                Donaciones</a></li>
                        <li><a href="#" onclick="selectComponent('Gastos', this)"><i class="fa fa-shopping-cart"></i>
                                Gastos</a></li>
                        <li><a href="#" onclick="selectComponent('CategoriaGastos', this)"><i class="fa fa-sticky-note"></i>
                                Categoría - Gastos</a></li>
                        <hr />
                        <li><a href="{{ route('profile.edit') }}"><i class="fa fa-user"></i> Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn  text-start w-100 ps-3"><i
                                        class="fa fa-sign-out-alt"></i> Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <main class="page-content">
            <div class="header">
                <h4 class="m-0" id="panel-title">Panel Administrativo</h4>
                <button class="toggle-btn" onclick="toggleSidebar()" id="headerToggle" style="display: none;">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const headerToggle = document.getElementById('headerToggle');

            sidebar.classList.toggle('hidden');

            if (sidebar.classList.contains('hidden')) {
                sidebarToggle.style.display = 'none';
                headerToggle.style.display = 'inline-block';
            } else {
                sidebarToggle.style.display = 'inline-block';
                headerToggle.style.display = 'none';
            }
        }

        function selectComponent(name, element) {
            // Enviar evento a Vue
            document.dispatchEvent(new CustomEvent('selectComponent', {
                detail: name
            }));

            // Quitar clase activa de todos los enlaces
            const links = document.querySelectorAll('#menu-items a');
            links.forEach(link => link.classList.remove('active'));

            // Agregar clase activa al enlace seleccionado
            if (element) {
                element.classList.add('active');
            }

            // Cambiar el título del panel
            const title = document.getElementById('panel-title');
            if (title) {
                title.textContent = name;
            }
        }
    </script>
</body>

</html>