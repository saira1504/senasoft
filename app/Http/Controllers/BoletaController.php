<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Evento;
use App\Models\Localidad;
use Illuminate\Http\Request;

class BoletaController extends Controller
{
    /**
     * Display a listing of the resource.
     * RF2: Listar boletas
     */
    public function index()
    {
        $boletas = Boleta::with(['evento', 'localidad'])->orderBy('created_at', 'desc')->get();
        
        // Mostrar vista diferente según el rol del usuario
        if (auth()->user()->isAdmin()) {
            return view('boletas.admin.index', compact('boletas'));
        } else {
            return view('boletas.comprador.index', compact('boletas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * RF2: Formulario para crear boletas con selección de evento y localidad
     */
    public function create()
    {
        $eventos = Evento::orderBy('nombre_evento')->get();
        $localidades = Localidad::orderBy('nombre_localidad')->get();
        return view('boletas.admin.create', compact('eventos', 'localidades'));
    }

    /**
     * Store a newly created resource in storage.
     * RF2: Crear boletas con evento, localidad, valor y cantidad
     */
    public function store(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'localidad_id' => 'required|exists:localidades,id',
            'valor_boleta' => 'required|numeric|min:0',
            'cantidad_disponible' => 'required|integer|min:1'
        ]);

        // Verificar que no exista ya una boleta para este evento y localidad
        $existeBoleta = Boleta::where('evento_id', $request->evento_id)
            ->where('localidad_id', $request->localidad_id)
            ->exists();

        if ($existeBoleta) {
            return back()->withErrors(['error' => 'Ya existe una boleta para este evento y localidad']);
        }

        Boleta::create($request->only([
            'evento_id',
            'localidad_id',
            'valor_boleta',
            'cantidad_disponible'
        ]));

        return redirect()->route('boletas.index')
            ->with('success', 'Boleta creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Boleta $boleta)
    {
        $boleta->load(['evento.artistas', 'localidad']);
        
        // Mostrar vista diferente según el rol del usuario
        if (auth()->user()->isAdmin()) {
            return view('boletas.admin.show', compact('boleta'));
        } else {
            return view('boletas.comprador.show', compact('boleta'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boleta $boleta)
    {
        $eventos = Evento::orderBy('nombre_evento')->get();
        $localidades = Localidad::orderBy('nombre_localidad')->get();
        return view('boletas.admin.edit', compact('boleta', 'eventos', 'localidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boleta $boleta)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'localidad_id' => 'required|exists:localidades,id',
            'valor_boleta' => 'required|numeric|min:0',
            'cantidad_disponible' => 'required|integer|min:1'
        ]);

        // Verificar que no exista ya una boleta para este evento y localidad (excluyendo la actual)
        $existeBoleta = Boleta::where('evento_id', $request->evento_id)
            ->where('localidad_id', $request->localidad_id)
            ->where('id', '!=', $boleta->id)
            ->exists();

        if ($existeBoleta) {
            return back()->withErrors(['error' => 'Ya existe una boleta para este evento y localidad']);
        }

        $boleta->update($request->only([
            'evento_id',
            'localidad_id',
            'valor_boleta',
            'cantidad_disponible'
        ]));

        return redirect()->route('boletas.index')
            ->with('success', 'Boleta actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boleta $boleta)
    {
        $boleta->delete();
        return redirect()->route('boletas.index')
            ->with('success', 'Boleta eliminada exitosamente');
    }
}
