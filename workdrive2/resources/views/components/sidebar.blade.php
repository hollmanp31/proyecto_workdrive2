<div class="sidebar">
    <div class="menu-header">
        <i class="bi bi-grid"></i>
        <span class="menu-text fs-5">Menú</span>
    </div>
    <ul class="nav flex-column px-2 mt-3 w-100">
        <li class="nav-item">
            <a href="/" class="nav-link text-white d-flex align-items-center">
                <i class="bi bi-house-door"></i>
                <span class="menu-text">Inicio</span>
            </a>
        </li>
        <li class="nav-item">
            <a href='{{ 'roles' }}' class="nav-link text-white d-flex align-items-center">
                {{-- <i class="bi bi-chat-dots"></i> --}}
                <i class="bi bi-dpad-fill"></i>
                <span class="menu-text">Roles</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('usuarios.index') }}" class="nav-link text-white d-flex align-items-center">
                {{-- <i class="bi bi-graph-up-arrow"></i> --}}
                <i class="bi bi-people-fill"></i>
                <span class="menu-text">usuarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center">
                <i class="bi bi-check-circle"></i>
                <span class="menu-text">acciones</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center">
                <i class="bi bi-lock"></i>
                <span class="menu-text">permisos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center">
                <i class="bi bi-gear-wide-connected"></i>
                <span class="menu-text">Configuración</span>
            </a>
        </li>
    </ul>
</div> 
