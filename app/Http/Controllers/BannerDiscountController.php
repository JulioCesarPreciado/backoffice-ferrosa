<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
class BannerDiscountController extends Controller
{
// Función que retorna todos los banners al index.
public function index()
{
    // Obtengo todos los registros de la BD ordenados por el más reciente.
    $banners = Banner::orderBy('validity', 'asc')
        ->orderBy('updated_at', 'desc')
        ->get();

    return Response::json([
        'banners' => $banners
    ]);
}

// Función que redirecciona a la vista create
public function create()
{
    return view('banners.sliders.create');
}

// Función que almacena el nuevo registro en la BD
public function store(Request $request)
{
    // Validación de los campos recibidos
    $request->validate([
        'title'     => 'required|string',
        'subtitle'  => 'nullable|string',
        'thumbnail' => 'required|image',
        'url'       => 'nullable|url',
        'validity'  => 'nullable|string',
    ]);

    try {
        // ### START Guardar imagen ###
        // Obtenemos el archivo del request
        $file = $request->file('thumbnail');

        //guarda la imagen en el disco banners
        $file->store('/', 'banners');

        // Preparo los datos a agregar
        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'thumbnail' => env('APP_URL') . "/imagenes-banners/". $file->hashName(),
            'url' => $request->url,
            'status' => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'validity' => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'id_user_created' => Auth::user()->id,
            'id_user_updated' => Auth::user()->id,
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
            'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
        ];

        // Inserta el nuevo registro a la BD y obtengo su ID
        $banner = Banner::create($data)->id;

        // Alerta de exito
        $notification = array(
            'message' => __('Record created!'),
            'alert-type' => 'success'
        );
        // Retorna a la vista
        return redirect()->route('banners.sliders.index')->with($notification);
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
public function show(Banner $banner)
{
    return view('banners.sliders.show', compact('banner'));
}

// Función que manda a la vista edit
public function edit(Banner $banner)
{
    return view('banners.sliders.edit', compact('banner'));
}

// Función que actualiza el registro en la BD
public function update(Request $request, Banner $banner)
{
    // Validación de los campos recibidos
    $request->validate([
        'title'     => 'required|string',
        'subtitle'  => 'nullable|string',
        'thumbnail' => 'nullable|image',
        'url'       => 'nullable|url',
        'validity'  => 'nullable|string',
    ]);

    try {
        // ### START Guardar imagen ###
        // Obtenemos el archivo del request
        $file = $request->file('thumbnail');

        $thumbnail = "";
        #Revisa si se modifico la imagen y pone la nueva, si no deja la que estaba
        if (isset($file)) {

            //separamos la ruta por "/" para obtener el nombre de la imagen guardada
            $extension = explode('/', $banner->thumbnail);
            //obtenemos el último parametro del array, que siempre va a ser el nombre de la imagen junto a su extensión
            $file_name = end($extension);

            //borramos la imagen del disco banners, donde se guardan todas las imagenes de los banners
            Storage::disk('banners')->delete($file_name);

            //guarda la nueva imagen en el disco banners
            $file->store('/', 'banners');

            //creo la nueva url para la imagen
            $thumbnail = env('APP_URL') . "/imagenes-banners/". $file->hashName();

        } else {
            $thumbnail = $banner->thumbnail;
        }
        // ### END Guardar imagen ###

        // Preparo los datos a actualizar
        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'thumbnail' => $thumbnail,
            'url' => $request->url,
            'status' => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'validity' => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'id_user_updated' => Auth::user()->id,
            'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_by' => Auth::user()->name
        ];

        // Actualiza el registro en la BD
        $banner->update($data);

        // Alerta de exito
        $notification = array(
            'message' => __('Record updated!'),
            'alert-type' => 'success'
        );
        // Retorna a la vista
        return redirect()->route('banners.sliders.index')->with($notification);
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
public function destroy(Banner $banner)
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
        $banner->update($data);
        return __('Record disabled!');
    } catch (QueryException $e) {
        return $e->errorInfo[2];
    }
}
}
