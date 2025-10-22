<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistaController extends Controller
{
    /**
     * Display a listing of the resource.
     * RF4: Listar artistas
     */
    public function index()
    {
        $artistas = Artista::orderBy('nombres')->get();
        return view('artistas.index', compact('artistas'));
    }

    /**
     * Show the form for creating a new resource.
     * RF4: Formulario para crear artistas
     */
    public function create()
    {
        return view('artistas.create');
    }

    /**
     * Store a newly created resource in storage.
     * RF4: Crear artistas con código, nombres, apellidos, género musical y ciudad natal
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo_artista' => 'required|string|max:50|unique:artistas',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'genero_musical' => 'required|string|max:255',
            'ciudad_natal' => 'required|string|max:255',
            'imagen_artista' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only([
            'codigo_artista',
            'nombres',
            'apellidos',
            'genero_musical',
            'ciudad_natal'
        ]);

        // Manejar subida de imagen
        if ($request->hasFile('imagen_artista')) {
            $data['imagen_artista'] = $request->file('imagen_artista')->store('artistas', 'public');
        }

        Artista::create($data);

        return redirect()->route('artistas.index')
            ->with('success', 'Artista creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artista $artista)
    {
        $artista->load('eventos');
        return view('artistas.show', compact('artista'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artista $artista)
    {
        return view('artistas.edit', compact('artista'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artista $artista)
    {
        $request->validate([
            'codigo_artista' => 'required|string|max:50|unique:artistas,codigo_artista,' . $artista->id,
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'genero_musical' => 'required|string|max:255',
            'ciudad_natal' => 'required|string|max:255',
            'imagen_artista' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only([
            'codigo_artista',
            'nombres',
            'apellidos',
            'genero_musical',
            'ciudad_natal'
        ]);

        // Manejar subida de imagen
        if ($request->hasFile('imagen_artista')) {
            // Eliminar imagen anterior si existe
            if ($artista->imagen_artista) {
                Storage::disk('public')->delete($artista->imagen_artista);
            }
            $data['imagen_artista'] = $request->file('imagen_artista')->store('artistas', 'public');
        }

        $artista->update($data);

        return redirect()->route('artistas.index')
            ->with('success', 'Artista actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artista $artista)
    {
        $artista->delete();
        return redirect()->route('artistas.index')
            ->with('success', 'Artista eliminado exitosamente');
    }
}
