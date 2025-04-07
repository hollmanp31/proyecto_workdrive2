<?php

namespace App\Http\Controllers; 
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Usuario; 

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
            return view('usuarios.index', compact('usuarios')); 
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos y almacenar el nuevo usuario
        $validated = $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
        ]);

        Usuario::create($validated);  // Crear el usuario

        return redirect()->route('usuarios.index');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Usuario::destroy($id);
        /* return redirect()->route('usuarios.index');  */
        return redirect()->route('usuarios.index')->with('eliminar', 'Usuario eliminado correctamente');
        //
    }
}
