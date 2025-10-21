<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     * RF3: Listar localidades
     */
    public function index()
    {
        $localidades = Localidad::orderBy('nombre_localidad')->get();
        return view('localidades.index', compact('localidades'));
    }

    /**
     * Show the form for creating a new resource.
     * RF3: Formulario para crear localidades
     */
    public function create()
    {
        return view('localidades.create');
    }

    /**
     * Store a newly created resource in storage.
     * RF3: Crear localidades con código y nombre
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo_localidad' => 'required|string|max:50|unique:localidades',
            'nombre_localidad' => 'required|string|max:255'
        ]);

        Localidad::create($request->only(['codigo_localidad', 'nombre_localidad']));

        return redirect()->route('localidades.index')
            ->with('success', 'Localidad creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Localidad $localidad)
    {
        $localidad->load('boletas.evento');
        return view('localidades.show', compact('localidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Localidad $localidad)
    {
        return view('localidades.edit', compact('localidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Localidad $localidad)
    {
        $request->validate([
            'codigo_localidad' => 'required|string|max:50|unique:localidades,codigo_localidad,' . $localidad->id,
            'nombre_localidad' => 'required|string|max:255'
        ]);

        $localidad->update($request->only(['codigo_localidad', 'nombre_localidad']));

        return redirect()->route('localidades.index')
            ->with('success', 'Localidad actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Localidad $localidad)
    {
        $localidad->delete();
        return redirect()->route('localidades.index')
            ->with('success', 'Localidad eliminada exitosamente');
    }
}
