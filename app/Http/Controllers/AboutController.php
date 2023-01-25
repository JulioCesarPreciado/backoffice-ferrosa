<?php

namespace App\Http\Controllers;

use App\Models\About;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;


class AboutController extends Controller
{
    public function index()
    {
        // Obtengo todos los registros
        $data = About::first();

        return view('about_us.index',  compact('data'));
    }
    public function update(Request $request, About $about)
    {
        // Validación de los campos recibidos
        $request->validate([
            'title' => 'required|string',
            'history' => 'required|string'
        ]);

        try {

            // Obtenemos el archivo del request
            $file = $request->file('image');

            $file_name = null;
            #Revisa si se modifico la imagen y pone la nueva, si no deja la que estaba
            if (isset($file)) {
                #Creamos el nombre del archivo
                $file_name = date('YmdHi') . '_about_' . $file->getClientOriginalName();
                #Borramos la foto anterior
                @unlink(public_path('storage/upload/about/' . $about->image));
                #Lo guardamos
                $file->move(public_path('storage/upload/about'), $file_name);
                #Generamos el path donde se guardará
                $file_name = fullPath()."/storage/upload/about/".$file_name;
            }
            // ### END Guardar imagen ###
            // Busca y actualiza el registro
            $data = [
                'title' => $request->title,
                'history' => $request->history,
                'slogan' => $request->slogan,
                'image' => $file_name,
                'ceo' => $request->ceo,
                'mission' => $request->mission,
                'vision' => $request->vision,
                'id_user_updated' => Auth::user()->id,
                'updated_by' => Auth::user()->name,
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
            ];

            // Actualiza el registro en la BD
            $about->update($data);

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
