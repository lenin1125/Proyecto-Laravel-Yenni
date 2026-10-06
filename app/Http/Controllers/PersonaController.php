<?php

// Define la ubicación (espacio de nombres) del controlador dentro de la estructura del proyecto
namespace App\Http\Controllers;

// Importa la clase Request de Laravel para capturar y procesar la información enviada desde la petición HTTP (Postman)
use Illuminate\Http\Request;

// Importa el modelo Persona para poder interactuar con la tabla 'personas' en la base de datos usando Eloquent
use App\Models\Persona;

// Definición de la clase del controlador que hereda de la clase base Controller
class PersonaController extends Controller
{
    /**
     * Método encargado de recibir, validar y guardar una nueva persona.
     * Se ejecuta cuando se realiza una petición HTTP POST a la ruta /api/personas
     */
    public function store(Request $request)
    {
        // 1. Aplica reglas de validación a los datos enviados en la petición
        $validatedData = $request->validate([
            // 'nombres': Debe enviarse obligatoriamente, ser un texto y tener máximo 100 caracteres
            'nombres' => 'required|string|max:100',

            // 'apellidos': Obligatorio, tipo texto y máximo 100 caracteres
            'apellidos' => 'required|string|max:100',

            // 'email': Obligatorio, debe tener formato de correo válido y ser único en la columna 'email' de la tabla 'personas'
            'email' => 'required|email|unique:personas,email',

            // 'telefono': Es opcional (nullable), si se envía debe ser un texto de máximo 20 caracteres
            'telefono' => 'nullable|string|max:20',
        ]);

        // 2. Si la validación pasa, crea e inserta el nuevo registro en la base de datos mediante Eloquent
        $persona = Persona::create($validatedData);

        // 3. Retorna una respuesta en formato JSON estructurada con el código de estado HTTP 201 (Created)
        return response()->json([
            'mensaje' => 'Persona registrada exitosamente', // Mensaje de éxito
            'data' => $persona                            // Retorna el registro recién creado con su ID y timestamps
        ], 201);
    }
}