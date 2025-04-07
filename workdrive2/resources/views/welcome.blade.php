@extends('layouts.app') 

@section('content') 
<div class="container mt-3 position-relative">
    <!-- Contenedor para las nubes (reutilizamos la animación de nubes) -->
    <div class="clouds-background">
        <div class="cloud cloud-1"></div>
        <div class="cloud cloud-2"></div>
        <div class="cloud cloud-3"></div>
    </div>

    <!-- Contenido principal -->
    <div class="content" style="background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); position: relative; z-index: 1;">
        <!-- Mensaje de bienvenida -->
        <div class="welcome-section text-center mb-4">
            <h1 class="welcome-title">¡Bienvenido a tu Dashboard!</h1>
            <p class="welcome-message">Aquí puedes gestionar tus usuarios, tareas y más.</p>
        </div>

        <!-- Estadísticas -->
        <div class="stats-section row mb-4">
            <div class="col-md-4">
                <div class="stat-card stat-appear">
                    <h3 class="stat-number">{{ $totalUsuarios ?? 10 }}</h3>
                    <p class="stat-label">Usuarios Registrados</p>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-primary btn-sm btn-like">Ver Usuarios</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card stat-appear" style="animation-delay: 0.2s;">
                    <h3 class="stat-number">{{ $tareasCompletadas ?? 25 }}</h3>
                    <p class="stat-label">Tareas Completadas</p>
                    <a href="#" class="btn btn-success btn-sm btn-like">Ver Tareas</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card stat-appear" style="animation-delay: 0.4s;">
                    <h3 class="stat-number">{{ $proyectosActivos ?? 5 }}</h3>
                    <p class="stat-label">Proyectos Activos</p>
                    <a href="#" class="btn btn-warning btn-sm btn-like">Ver Proyectos</a>
                </div>
            </div>
        </div>

        <!-- Enlaces rápidos -->
        <div class="quick-links text-center">
            <h3 class="mb-3">Acciones Rápidas</h3>
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary btn-like m-2">Gestionar Usuarios</a>
            <a href="#" class="btn btn-success btn-like m-2">Crear Tarea</a>
            <a href="#" class="btn btn-info btn-like m-2">Ver Reportes</a>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
        /* Eliminar márgenes y asegurar que cubra todo el espacio */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden; /* Eliminar scroll horizontal */
        } 

        .container {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100vh; /* Ocupar toda la altura de la pantalla */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centrar el contenido verticalmente */
        }

        /* Estilos para las nubes (reutilizados) */
        .clouds-background {
            position: absolute;     
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: linear-gradient(to bottom, #87CEEB, #E0F7FA);
            z-index: 0;
        }

        .cloud {
            position: absolute;
            background: white;
            border-radius: 100px;
            opacity: 0.8;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: float 20s linear infinite;
        }

        .cloud-1 {
            width: 150px;
            height: 50px;
            top: 20%;
            left: -150px;
            animation-duration: 25s;
        }

        .cloud-2 {
            width: 200px;
            height: 70px;
            top: 40%;
            left: -200px;
            animation-duration: 30s;
            animation-delay: 5s;
        }

        .cloud-3 {
            width: 120px;
            height: 40px;
            top: 60%;
            left: -120px;
            animation-duration: 20s;
            animation-delay: 10s;
        }

        @keyframes float {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100vw);
            }
        }

        /* Estilos para el mensaje de bienvenida */
        .welcome-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .welcome-message {
            font-size: 1.2rem;
            color: #7f8c8d;
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
            animation-delay: 0.3s;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estilos para las tarjetas de estadísticas */
        .stat-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
        }

        .stat-label {
            font-size: 1rem;
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estilos para el efecto de "Like" (reutilizado) */
        .like-effect {
            position: absolute;
            font-size: 20px;
            color: #ff4d4d;
            pointer-events: none;
            animation: likeAnimation 1s ease-in-out forwards;
        }

        @keyframes likeAnimation {
            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            50% {
                opacity: 0.8;
                transform: translateY(-30px) scale(1.2);
            }
            100% {
                opacity: 0;
                transform: translateY(-60px) scale(1);
            }
        }

        /* Efecto de hover en los botones (reutilizado) */
        .btn {
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-info:hover {
            background-color: #138496;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Efecto de "Like" al hacer clic en los botones
            document.querySelectorAll('.btn-like').forEach(button => {
                button.addEventListener('click', function(e) {
                    const rect = button.getBoundingClientRect();
                    const like = document.createElement('span');
                    like.classList.add('like-effect');
                    like.innerHTML = '❤️';
                    like.style.left = `${rect.left + rect.width / 2}px`;
                    like.style.top = `${rect.top}px`;
                    document.body.appendChild(like);

                    setTimeout(() => {
                        like.remove();
                    }, 1000);
                });
            });
        });
    </script>
@endsection  