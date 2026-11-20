<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EstudianteController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Estudiante::all(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre'   => 'required|string|max:255',
            'correo'   => 'required|email|unique:estudiantes,correo|max:255',
            'programa' => 'required|string|max:255',
        ]);

        $estudiante = Estudiante::create($validated);

        return response()->json([
            'message' => 'Estudiante registrado exitosamente',
            'data'    => $estudiante
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json([
                'message' => 'Estudiante no encontrado'
            ], 404);
        }

        return response()->json($estudiante, 200);
    }
}
