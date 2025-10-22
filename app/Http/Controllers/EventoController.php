<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     * RF5: Consulta de eventos por fecha, municipio o departamento
     */
    public function index(Request $request)
    {
        $query = Evento::with(['artistas', 'boletas.localidad']);
        

        // Filtros para RF5
        if ($request->filled('fecha')) {
            $query->whereDate('fecha_hora_inicio', $request->fecha);
        }

        if ($request->filled('municipio')) {
            $query->where('municipio', 'like', '%' . $request->municipio . '%');
        }

        if ($request->filled('departamento')) {
            $query->where('departamento', 'like', '%' . $request->departamento . '%');
        }

        $eventos = $query->orderBy('fecha_hora_inicio')->get();

        // Mostrar vista diferente según el rol del usuario
        if (auth()->user()->isAdmin()) {
            return view('eventos.admin.index', compact('eventos'));
        } else {
            return view('eventos.comprador.index', compact('eventos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artistas = Artista::all();
        return view('eventos.admin.create', compact('artistas'));
    }

    /**
     * Store a newly created resource in storage.
     * RF1: Registro de eventos con código auto-incrementable
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
            'municipio' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'imagen_evento' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'artistas' => 'array'
        ]);

        $data = $request->only([
            'nombre_evento',
            'descripcion',
            'fecha_hora_inicio',
            'fecha_hora_fin',
            'municipio',
            'departamento'
        ]);

        // Manejar subida de imagen
        if ($request->hasFile('imagen_evento')) {
            $data['imagen_evento'] = $request->file('imagen_evento')->store('eventos', 'public');
        }

        $evento = Evento::create($data);

        // Asociar artistas si se seleccionaron
        if ($request->has('artistas')) {
            $evento->artistas()->attach($request->artistas);
        }

        return redirect()->route('eventos.admin.index')
            ->with('success', 'Evento creado exitosamente. Código: ' . $evento->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        $evento->load(['artistas', 'boletas.localidad']);
        
        // Mostrar vista diferente según el rol del usuario
        if (auth()->user()->isAdmin()) {
            return view('eventos.admin.show', compact('evento'));
        } else {
            return view('eventos.comprador.show', compact('evento'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        $artistas = Artista::all();
        $evento->load('artistas');
        return view('eventos.admin.edit', compact('evento', 'artistas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
            'municipio' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'imagen_evento' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'artistas' => 'array'
        ]);

        $data = $request->only([
            'nombre_evento',
            'descripcion',
            'fecha_hora_inicio',
            'fecha_hora_fin',
            'municipio',
            'departamento'
        ]);

        // Manejar subida de imagen
        if ($request->hasFile('imagen_evento')) {
            // Eliminar imagen anterior si existe
            if ($evento->imagen_evento) {
                Storage::disk('public')->delete($evento->imagen_evento);
            }
            $data['imagen_evento'] = $request->file('imagen_evento')->store('eventos', 'public');
        }

        $evento->update($data);

        // Actualizar artistas
        if ($request->has('artistas')) {
            $evento->artistas()->sync($request->artistas);
        } else {
            $evento->artistas()->detach();
        }

        return redirect()->route('eventos.admin.index')
            ->with('success', 'Evento actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.admin.index')
            ->with('success', 'Evento eliminado exitosamente');
    }
}
