<?php

namespace App\Http\Controllers;

use App\Models\About;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;


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
            'title'         => 'required|string',
            'history'       => 'required|string',
            'link_video'    => 'nullable|url'
        ], [
            "link_video.url"    => __("You must enter a valid url")
        ]);

        try {

            $image = $request->file('image');

            //recupero el path de la imagen
            $path_image = $about->image;
            
            // Revisa si se modifico la imagen
            if (isset($image)) {
                $path_image = $this->saveImage($image, $path_image);
            }

            $data = [
                'title' => $request->title,
                'history' => $request->history,
                'slogan' => $request->slogan,
                'image' => $path_image,
                'ceo' => $request->ceo,
                'mission' => $request->mission,
                'vision' => $request->vision,
                'link_video'    => $request->link_video,
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

    private function saveImage($image, $path) 
    {
        // Creamos el nombre del archivo
        $new_image_name = date('YmdHi') . '_icon_' . $image->getClientOriginalName();
        //separamos la ruta por "/" para obtener el nombre de la imagen guardada
        $extension = explode('/', $path);
        //obtenemos el último parametro del array, que siempre va a ser el nombre de la imagen junto a su extensión
        $file_name = end($extension);

        //borramos la imagen del disco iconos, donde se guardan todas las imagenes de los iconos
        Storage::disk('iconos')->delete($file_name);
        // Lo guardamos
        Storage::putFileAs('upload/iconos/', $image, $new_image_name);
        // agrega al data la ruta del archivo
        return env('APP_URL') . "/iconos/". $new_image_name;
    }
}
