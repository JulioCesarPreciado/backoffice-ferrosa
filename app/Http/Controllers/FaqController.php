<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class FaqController extends Controller
{
    // Función que retorna todos los registros al index.
    public function index()
    {
        // Obtengo todos los registros de la BD ordenados por el más reciente.
        $faqs = Faq::orderBy('validity', 'asc')
            ->orderBy('updated_at', 'desc')
            ->get();

        return Response::json([
            'faqs' => $faqs
        ]);
    }

    // Función que redirecciona a la vista create
    public function create()
    {
        return view('site_settings.faq.create');
    }

    // Función que almacena el nuevo registro en la BD
    public function store(Request $request)
    {
        // Validación de los campos recibidos
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            // 'validity' => 'string',
        ]);

        try {
            // Preparo los datos a agregar
            $data = [
                'question' => $request->question,
                'answer' => $request->answer,
                'status' => $request->validity ? 'ACTIVO' : 'INACTIVO',
                'validity' => $request->validity ? 'ACTIVO' : 'INACTIVO',
                'id_user_created' => Auth::user()->id,
                'id_user_updated' => Auth::user()->id,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
                'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
            ];

            // Inserta el nuevo registro a la BD
            Faq::create($data);

            // Alerta de exito
            $notification = array(
                'message' => __('Record created!'),
                'alert-type' => 'success'
            );
            // Retorna a la vista
            return redirect()->route('site_settings.faq.index')->with($notification);
        } catch (QueryException $e) {
            // Alerta de error
            $notification = array(
                'message' =>  $e->errorInfo[2],
                'alert-type' => 'error'
            );
            // Retorna a la vista
            return redirect()->back()->with($notification);
        }
    }

    // Función que manda a la vista show
    public function show(Faq $faq)
    {
        return view('site_settings.faq.show', compact('faq'));
    }

    // Función que manda a la vista edit
    public function edit(Faq $faq)
    {
        return view('site_settings.faq.edit', compact('faq'));
    }

    // Función que actualiza el registro en la BD
    public function update(Request $request, Faq $faq)
    {
        // Validación de los campos recibidos
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            // 'validity' => 'string',
        ]);

        try {
            // Preparo los datos a actualizar
            $data = [
                'question' => $request->question,
                'answer' => $request->answer,
                'status' => $request->validity ? 'ACTIVO' : 'INACTIVO',
                'validity' => $request->validity ? 'ACTIVO' : 'INACTIVO',
                'id_user_updated' => Auth::user()->id,
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_by' => Auth::user()->name
            ];

            // Actualiza el registro en la BD
            $faq->update($data);

            // Alerta de exito
            $notification = array(
                'message' => __('Record updated!'),
                'alert-type' => 'success'
            );
            // Retorna a la vista
            return redirect()->route('site_settings.faq.index')->with($notification);
        } catch (QueryException $e) {
            // Alerta de error
            $notification = array(
                'message' =>  $e->errorInfo[2],
                'alert-type' => 'error'
            );
            // Retorna a la vista
            return redirect()->back()->with($notification);
        }
    }

    // Función que elimina el registro de la BD
    public function destroy(Faq $faq)
    {
        try {
            // Prepara los datos a actualizar
            $data = [
                'status' => 'INACTIVO',
                'validity' => 'INACTIVO',
                'id_user_updated' => Auth::user()->id,
                'updated_by' => Auth::user()->name,
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
            ];
            // Actualiza el registro a borrado.
            $faq->update($data);
            return __('Record disabled!');
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }
}
