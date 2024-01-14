<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContacto;
use App\Models\Contacto;
use Illuminate\Http\Request;

/**
 * Controlador para la gestión de contactos.
 *
 * Este controlador maneja las operaciones CRUD para los contactos
 * como mostrar, guardar y borrar contactos.
 */
class ContactoController extends Controller
{
    /**
     * Muestra todos los contactos almacenados.
     *
     * Retorna una respuesta JSON que incluye un estado de éxito o fallo,
     * un mensaje descriptivo, y los datos de los contactos si están disponibles.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el estado de la operación,
     *                                       mensaje y datos de los contactos.
     */
    public function mostrarContactos()
    {
        $contactos = Contacto::all();

        if (is_null($contactos)) {
            return response()->json([
                'estado'    => false,
                'mensaje'   => 'No hay contactos en los registros.',
                'contactos' => false
            ], 204);
        }

        return response()->json([
            'estado'    => true,
            'mensaje'   => 'Lista de todos los contactos.',
            'contactos' => $contactos
        ], 200);
    }


    /**
     * Guarda un nuevo contacto en la base de datos.
     *
     * Valida y guarda un contacto recibido en la petición. Retorna una respuesta JSON
     * con el estado de la operación y detalles del contacto guardado o un mensaje de error si ocurre un fallo.
     * @param CreateContacto $request Datos validados del contacto a guardar.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el estado de la operación,
     *                                       mensaje y detalles del contacto guardado.
     */
    public function guardarContacto (CreateContacto $request)
    {
        $contacto = Contacto::create($request->all());
        if (is_null($contacto)) {
            return response()-> json([
                'estado'   => false,
                'mensaje'  => 'Error. El contacto no se ha guardado.',
                'contacto' => false], 400);
        }
        return response()-> json([
            'estado'   => true,
            'mensaje'  => 'Contacto registrado exitósamente.',
            'contacto' => $contacto], 201);
    }

    /**
     * Elimina un contacto específico.
     *
     * Busca y elimina un contacto basado en su ID. Retorna una respuesta JSON
     * con el estado de la operación y un mensaje descriptivo.
     *
     * @param int $id El ID del contacto a eliminar.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el estado de la operación
     *                                       y un mensaje descriptivo.
     */
    public function borrarContacto ($id)
    {   //Borrado definitivo.
        $contacto = Contacto::find($id);
        if (is_null($contacto)) {
            return response()-> json([
                'estado'  => false,
                'mensaje' => 'Error. Recurso no encontrado.'], 404);
        }

        $contacto->delete();
        return response()-> json([
            'estado'  => true,
            'mensaje' => 'El contacto ha sido eliminado.'], 202);
    }
}
