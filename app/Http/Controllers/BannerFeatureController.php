<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\Product;

class BannerFeatureController extends Controller
{
 // Función que retorna todos los banners al index.
public function index()
{
    // Obtengo todos los registros de la BD ordenados por el más reciente.
    $banners = Banner::where('type','=','destacados')->orderBy('validity', 'asc')
        ->orderBy('updated_at', 'desc')
        ->get();

    $banners = $banners->map(function($banner) {
        return[
            'id'            => $banner->id,
            'thumbnail'     => $banner->producto->thumbnail,
            'title'         => $banner->title,
            'status'        => $banner->status,
            'updated_at'    => $banner->updated_at,
            'validity'      => $banner->validity,
        ];
    });

    return Response::json([
        'banners' => $banners
    ]);
}

// Función que redirecciona a la vista create
public function create()
{

    $productos = Product::where('validity', '=', 'ACTIVO')->get();

    return view('banners.features.create', ["records" => $productos]);
}

// Función que almacena el nuevo registro en la BD
public function store(Request $request)
{
    // Validación de los campos recibidos
    $request->validate([
        'title'     => 'required|string',
        'subtitle'  => 'nullable|string',
        'product_id' => 'required|unique:banners,product_id|exists:products,id',
        'url'       => 'nullable|url',
        'validity'  => 'nullable|string',
    ]);

    try {

        $data = [
            'title'     => $request->title,
            'subtitle'  => $request->subtitle,
            'thumbnail' => "banner destacados",
            'url'       => $request->url,
            'status'    => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'validity'  => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'type'      => 'destacados',
            'product_id'=> $request->product_id
        ];

        $banner = Banner::createWithAll($data);

        // Alerta de exito
        $notification = array(
            'message' => __('Record created!'),
            'alert-type' => 'success'
        );
        // Retorna a la vista
        return redirect()->route('banners.features.index')->with($notification);
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
public function show(Banner $banner_featured)
{
    $records = Product::where('status', '=', 'ACTIVO')->get();
    return view('banners.features.show', compact('banner_featured', 'records'));
}

// Función que manda a la vista edit
public function edit(Banner $banner_featured)
{
    $products_in_banners = Banner::where('type', 'destacados')->where('status', 'ACTIVO')->pluck('product_id')->toArray();

    $products_ids = array_flip($products_in_banners);
    $products_ids = array_flip($products_ids);
    $products_ids = array_values($products_ids);

    $products_ids = array_filter($products_ids, function($item) use($banner_featured) {
        return $item != $banner_featured->product_id;
    });
    $records = Product::where('status', '=', 'ACTIVO')->whereNotIn('id', $products_ids)->get();
    return view('banners.features.edit', compact('banner_featured', 'records'));
}

// Función que actualiza el registro en la BD
public function update(Request $request, Banner $banner_featured)
{
    // Validación de los campos recibidos
    $request->validate([
        'title'     => 'required|string',
        'subtitle'  => 'nullable|string',
        'thumbnail' => 'nullable|image',
        'url'       => 'nullable|url',
        'product_id'=> 'required|unique:banners,product_id,' .$banner_featured->id,
        'validity'  => 'nullable|string',
    ]);

    try {

        // Preparo los datos a actualizar
        $data = [
            'title'             => $request->title,
            'subtitle'          => $request->subtitle,
            'url'               => $request->url,
            'status'            => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'validity'          => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'product_id'        => $request->product_id,
            'id_user_updated'   => Auth::user()->id,
            'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_by'        => Auth::user()->name
        ];

        // Actualiza el registro en la BD
        $banner_featured->update($data);

        // Alerta de exito
        $notification = array(
            'message' => __('Record updated!'),
            'alert-type' => 'success'
        );
        // Retorna a la vista
        return redirect()->route('banners.features.index')->with($notification);
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
public function destroy(Banner $banner_featured)
{
    try {
        $banner_featured->delete();
        return __('Record disabled!');
    } catch (QueryException $e) {
        return $e->errorInfo[2];
    }
}
}
