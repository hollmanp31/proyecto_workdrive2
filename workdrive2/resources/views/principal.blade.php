@extends('layouts.app') {{-- Usa la plantilla base --}}

@section('content')
    <h1>Bienvenido a la página principal</h1>
@endsection

@section('scripts')
    @include('components.scripts') {{-- Esto sí puede ir aquí si necesitas scripts adicionales --}}
@endsection  