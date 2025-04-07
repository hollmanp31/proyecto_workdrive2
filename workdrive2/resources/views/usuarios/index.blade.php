@extends('layouts.app')

@section('css') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> 
<link rel="stylesheet" hfre="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
@endsection 

@section('content') 
<div class="container mt-3"> 
     <!-- Alerta personalizada -->
     <div id="autoguardadoAlert" class="autoguardado-alert">
        <div class="alert-ranura"></div>
        <div class="alert-content">
            <span class="alert-highlight"></span>
            <span class="alert-message">Tus datos se guardarán temporalmente en tu navegador si cierras el formulario con el botón "X". Se eliminarán si haces clic en "Guardar" o "Cancelar".</span>
        </div>
    </div>

    <div class="content content-wrapper"> 
    <div class="header d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0" style="font-size: 1.9rem; font-weight: bold;">Lista de Usuarios</h2> 
    {{-- <div class="container-content">
        <div class="table-container"> --}}
                <button class="btn btn-primary" style="border-radius: 5px;" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
                    + Agregar Usuario 
                </button> 
            </div> 
        <div class="table-container"> 
        <table class="table" id="usuarios">  
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaUsuarios">
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></button> 

                            <!-- Formulario para eliminar -->
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class=" d-inline formulario-eliminar" style="display:inline;">
                        @csrf
                        @method('DELETE') 
                        <button type="button" class="btn btn-danger btn-sm btn-eliminar"> 
                            <i class="bi bi-trash"></i>
                        </button> 
                    </form>         
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
</div> 
</div> 

<!-- Modal Agregar Usuario -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content"> 

            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarUsuarioLabel">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarUsuario" action="{{ route('usuarios.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailUsuario" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailUsuario" name="email" required> 
                    </div> 
                    <div class="modal-footer d-flex justify-content-end"> 
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

@endsection 

@section('scripts') {{-- Para agregar scripts desde las vistas extendidas --}} 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<script> 
    document.addEventListener("DOMContentLoaded", function() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    document.querySelectorAll('.btn-eliminar').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // ✅ Importante para evitar que el form se envíe antes

            const form = this.closest("form");

            swalWithBootstrapButtons.fire({
                title: "¿Estás seguro?",
                text: "No podrás revertir esta acción.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "No, cancelar",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // ✅ Mostrar alerta de éxito ANTES de enviar el formulario
                    swalWithBootstrapButtons.fire({
                        title: "Eliminado",
                        text: "El usuario ha sido eliminado correctamente.",
                        icon: "success",
                        confirmButtonText: "De acuerdo"
                    }).then(() => {
                        form.submit();
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelado",
                        text: "El usuario está a salvo",
                        icon: "error",
                        confirmButtonText: "De acuerdo"
                    });
                }
            });
        });
    });
}); 

// Script de autoguardado y manejo de la alerta
if (document.getElementById('modalAgregarUsuario')) {
            let closeMethod = ''; // Variable para rastrear cómo se cerró el modal
            const alert = document.getElementById('autoguardadoAlert');
            const alertRanura = alert.querySelector('.alert-ranura');
            const alertContent = alert.querySelector('.alert-content');
            let isContentVisible = false; // Estado para rastrear si el contenido está visible
            let autoCloseTimeout = null; // Para manejar el temporizador de cierre automático

            // Función para mostrar el contenido y reiniciar el temporizador
            function showContent() {
                // Cancelar el temporizador anterior si existe
                if (autoCloseTimeout) {
                    clearTimeout(autoCloseTimeout);
                }

                // Mostrar el contenido
                alertContent.classList.remove('hide');
                alertContent.classList.add('show');
                isContentVisible = true;

                // Iniciar un nuevo temporizador para cerrar después de 8 segundos
                autoCloseTimeout = setTimeout(function() {
                    if (isContentVisible) {
                        alertContent.classList.remove('show');
                        alertContent.classList.add('hide');
                        isContentVisible = false;
                    }
                }, 8000);
            }

            // Mostrar la ranura y el contenido al abrir el modal
            document.getElementById('modalAgregarUsuario').addEventListener('shown.bs.modal', function() {
                // Mostrar la alerta (ranura y contenido)
                alert.classList.remove('hide');
                alert.classList.add('show');

                // Mostrar el contenido inmediatamente
                showContent();

                // Restaurar los datos del formulario
                const nombre = localStorage.getItem('formNombre');
                const email = localStorage.getItem('formEmail');

                if (nombre) {
                    document.getElementById('nombre').value = nombre;
                }
                if (email) {
                    document.getElementById('email').value = email;
                }
            });

            // Alternar la visibilidad del contenido al hacer clic en la ranura
            alertRanura.addEventListener('click', function() {
                if (isContentVisible) {
                    // Si el contenido está visible, ocultarlo
                    if (autoCloseTimeout) {
                        clearTimeout(autoCloseTimeout);
                    }
                    alertContent.classList.remove('show');
                    alertContent.classList.add('hide');
                    isContentVisible = false;
                } else {
                    // Si el contenido está oculto, mostrarlo
                    showContent();
                }
            });

            // Ocultar la alerta cuando el modal se cierre
            document.getElementById('modalAgregarUsuario').addEventListener('hidden.bs.modal', function() {
                // Cancelar el temporizador si existe
                if (autoCloseTimeout) {
                    clearTimeout(autoCloseTimeout);
                }

                alert.classList.remove('show');
                alert.classList.add('hide');
                alertContent.classList.remove('show');
                alertContent.classList.add('hide');
                isContentVisible = false;

                if (closeMethod === 'cerrar') {
                    // Si se cerró con "X", guardar los datos en localStorage
                    const nombre = document.getElementById('nombre').value;
                    const email = document.getElementById('email').value;
                    if (nombre) localStorage.setItem('formNombre', nombre);
                    if (email) localStorage.setItem('formEmail', email);
                } else {
                    // Si se cerró con "Cancelar" o "Guardar", limpiar los datos
                    localStorage.removeItem('formNombre');
                    localStorage.removeItem('formEmail');
                }
                closeMethod = ''; // Reiniciar la variable
            });

            // Identificar si se hace clic en "Cancelar"
            document.querySelector('#modalAgregarUsuario .btn-secondary[data-bs-dismiss="modal"]').addEventListener('click', function() {
                closeMethod = 'cancelar';
            });

            // Identificar si se hace clic en "X"
            document.querySelector('#modalAgregarUsuario .btn-close').addEventListener('click', function() {
                closeMethod = 'cerrar';
            });

            // Limpiar los datos al enviar el formulario (botón "Guardar")
            document.getElementById('formAgregarUsuario').addEventListener('submit', function() {
                closeMethod = 'guardar';
            });
        }     
    </script> 
@endsection 

@section('scripts') 
<script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> 
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script> 
<script src="hhttps://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script> 

<script> 
</script> 
@endsection
{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("formAgregarUsuario").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        fetch("{{ route('usuarios.store') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.success);
                location.reload(); // Recargar la página para actualizar la tabla
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
</script>  --}}
{{-- @endsection --}}
