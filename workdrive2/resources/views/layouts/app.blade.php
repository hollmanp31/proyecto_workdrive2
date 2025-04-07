<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>

     {{-- <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
     <!-- DataTables CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
 
     <!-- Bootstrap Icons (para los íconos) -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> --}}

    {{-- Estilos globales --}}
    @include('components.scripts') {{-- Incluye los scripts y estilos comunes --}} 

    {{-- Estilos específicos de la vista --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> --}}
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}} 
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .fade {
            transition: 0.5s;
        }
    </style> 

    @yield('styles') {{-- Permite agregar estilos adicionales desde las vistas extendidas --}} 
     {{-- Permite agregar scripts adicionales desde las vistas extendidas --}} 
</head>
<body>
    {{-- <div class="container-fluid">
        <div class="row">
        <div class="col-md-2">  --}}
        {{-- Sidebar  --}}
        @include('components.sidebar') 

        {{-- Barra superior común --}}
        @include('components.topbar')
    
        {{-- Contenido dinámico --}}
        <div class="content">
            @yield('content') 
            <!-- jQuery (requerido por DataTables) -->
            {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <!-- DataTables JS -->
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> --}}
        </div>

        {{-- Scripts globales --}} 
        @yield('scripts') {{-- Para agregar scripts desde las vistas extendidas --}} 
</body>
</html> 

