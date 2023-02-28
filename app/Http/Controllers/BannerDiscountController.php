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
use App\Models\ProductDiscount;

class BannerDiscountController extends Controller
{
// Función que retorna todos los banners al index.
public function index()
{
    // Obtengo todos los registros de la BD ordenados por el más reciente.
    $banners = Banner::where('type','=','descuentos')->orderBy('validity', 'asc')
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

    $products_in_banners = Banner::where('type', 'descuentos')->where('status', 'ACTIVO')->pluck('product_id')->toArray();

    $products_ids = array_flip($products_in_banners);
    $products_ids = array_flip($products_ids);
    $products_ids = array_values($products_ids);

    $productos = ProductDiscount::where('status', '=', 'ACTIVO')->whereNotIn('product_id', $products_ids)->get();

    return view('banners.discounts.create', ["records" => $productos]);
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
            'thumbnail' => "banner descuentos",
            'url'       => $request->url,
            'status'    => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'validity'  => $request->validity ? 'ACTIVO' : 'INACTIVO',
            'type'      => 'descuentos',
            'product_id'=> $request->product_id
        ];

        $banner = Banner::createWithAll($data);

        // Alerta de exito
        $notification = array(
            'message' => __('Record created!'),
            'alert-type' => 'success'
        );
        // Retorna a la vista
        return redirect()->route('banners.discounts.index')->with($notification);
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
public function show(Banner $banner_discount)
{
    $records = ProductDiscount::where('status', '=', 'ACTIVO')->get();
    return view('banners.discounts.show', compact('banner_discount', 'records'));
}

// Función que manda a la vista edit
public function edit(Banner $banner_discount)
{
    $products_in_banners = Banner::where('type', 'descuentos')->where('status', 'ACTIVO')->pluck('product_id')->toArray();

    $products_ids = array_flip($products_in_banners);
    $products_ids = array_flip($products_ids);
    $products_ids = array_values($products_ids);

    $products_ids = array_filter($products_ids, function($item) use($banner_discount) {
        return $item != $banner_discount->product_id;
    });

    $records = ProductDiscount::where('status', '=', 'ACTIVO')->whereNotIn('product_id', $products_ids)->get();
    return view('banners.discounts.edit', compact('banner_discount', 'records'));
}

// Función que actualiza el registro en la BD
public function update(Request $request, Banner $banner_discount)
{
    // Validación de los campos recibidos
    $request->validate([
        'title'     => 'required|string',
        'subtitle'  => 'nullable|string',
        'thumbnail' => 'nullable|image',
        'url'       => 'nullable|url',
        'product_id'=> 'required|unique:banners,product_id,' .$banner_discount->id,
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
        $banner_discount->update($data);

        // Alerta de exito
        $notification = array(
            'message' => __('Record updated!'),
            'alert-type' => 'success'
        );
        // Retorna a la vista
        return redirect()->route('banners.discounts.index')->with($notification);
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
public function destroy(Banner $banner_discount)
{
    try {
        $banner_discount->delete();
        return __('Record disabled!');
    } catch (QueryException $e) {
        return $e->errorInfo[2];
    }
}
}
