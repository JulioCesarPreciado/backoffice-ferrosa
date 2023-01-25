<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SeoController extends Controller
{
    public function index()
    {
        // Obtengo todos los registros de la BD ordenados por el más reciente.
        $seo = Seo::first();

        return view('site_settings.seo.index', compact('seo'));
    }

    // Función que actualiza los datos de las configuraciones del SEO
    public function update(Request $request, Seo $seo)
    {
        // Validación de los campos recibidos
        $request->validate([
            'meta_author' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
            'google_analytics' => 'nullable|string'
        ]);

        try {
            // Busca y actualiza el registro
            $data = [
                'meta_author' => $request->meta_author,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'google_analytics' => $request->google_analytics,
                'id_user_updated' => Auth::user()->id,
                'updated_by' => Auth::user()->name,
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
            ];

            // Actualiza el registro en la BD
            $seo->update($data);

            // Alerta de exito
            $notification = array(
                'message' => __('Record updated!'),
                'alert-type' => 'success'
            );
            // Retornamos a la vista
            return redirect()->back()->with($notification);
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
}
