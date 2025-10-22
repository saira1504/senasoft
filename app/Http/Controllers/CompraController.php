<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Boleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    /**
     * Mostrar el historial de compras del usuario
     */
    public function historial()
    {
        $compras = Auth::user()->compras()
            ->with(['boleta.evento', 'boleta.localidad'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('compras.historial', compact('compras'));
    }

    /**
     * Mostrar el formulario de compra de boletas
     */
    public function create(Boleta $boleta)
    {
        $boleta->load(['evento', 'localidad']);
        return view('compras.create', compact('boleta'));
    }

    /**
     * Procesar la compra de boletas
     */
    public function store(Request $request, Boleta $boleta)
    {
        $request->validate([
            'cantidad_comprada' => 'required|integer|min:1|max:' . $boleta->cantidad_disponible,
            'metodo_pago' => 'required|string|in:efectivo,tarjeta,transferencia',
            'observaciones' => 'nullable|string|max:500'
        ]);

        $cantidad = $request->cantidad_comprada;
        $precio_unitario = $boleta->valor_boleta;
        $total = $precio_unitario * $cantidad;

        // Crear la compra
        $compra = Compra::create([
            'user_id' => Auth::id(),
            'boleta_id' => $boleta->id,
            'cantidad_comprada' => $cantidad,
            'precio_unitario' => $precio_unitario,
            'total_pagado' => $total,
            'estado' => 'confirmada',
            'metodo_pago' => $request->metodo_pago,
            'observaciones' => $request->observaciones
        ]);

        // Actualizar la cantidad disponible de boletas
        $boleta->decrement('cantidad_disponible', $cantidad);

        return redirect()->route('compras.historial')
            ->with('success', "Compra realizada exitosamente. Total pagado: $" . number_format($total, 0, ',', '.'));
    }

    /**
     * Mostrar detalles de una compra específica
     */
    public function show(Compra $compra)
    {
        // Verificar que la compra pertenece al usuario autenticado
        if ($compra->user_id !== Auth::id()) {
            abort(403, 'No tienes permisos para ver esta compra.');
        }

        $compra->load(['boleta.evento', 'boleta.localidad']);
        return view('compras.show', compact('compra'));
    }
}