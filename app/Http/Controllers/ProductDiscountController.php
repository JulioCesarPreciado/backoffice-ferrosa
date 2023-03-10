<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDiscount;
use App\Models\Product;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProductDiscountController extends Controller
{
    // Función que retorna todos los productos con descuento al index.
    public function index()
    {
        // Obtengo todos los registros de la BD ordenados por el más reciente.
        $products_discount = ProductDiscount::orderBy('updated_at', 'DESC')->get();

        $products_discount = $products_discount->map(function($product_discount) {
            return[
                'id'                    => $product_discount->id,
                'image'                 => $product_discount->producto->thumbnail,
                'product_name'          => $product_discount->producto->name,
                'discount_start_date'   => $product_discount->discount_start_date,
                'discount_end_date'     => $product_discount->discount_end_date,
                'percentage'            => $product_discount->percentage,
                'discount'              => $product_discount->discount,
                'status'                => $product_discount->status
            ];
        });

        return Response::json([
            'data' => $products_discount
        ]);
    }

    // Función que redirecciona a la vista create
    public function create()
    {
        return view('products.products-discount.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'            => 'required|exists:products,id|unique:product_discounts,product_id',
            'discount_start_date'   => 'required',
            'discount_end_date'     => 'required',
            'percentage'            => 'required',
            'discount'              => 'required',           
        ], [
            'product_id.required'           => __('The product is required'),
            'product_id.unique'             => __('The selected product already has a discount'),
            'discount_start_date.required'  => __('The discount start date is required'),
            'discount_end_date.required'    => __('The discount end date is required'),
            'percentage.required'           => __('The percentage is required'),
            'discount.required'             => __('The discount is required')
        ]);

        try{

            ProductDiscount::createWithAll($request->all());

            // Alerta de exito
            $notification = array(
                'message' => __('Product discount created!'),
                'alert-type' => 'success'
            );
            // Retorna a la vista
            return redirect()->route('products.discount.index')->with($notification);

        }catch(QueryException $e){
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
    public function show(ProductDiscount $product_discount)
    {
        return view('products.products-discount.show', compact('product_discount'));
    }

    // Función que manda a la vista edit
    public function edit(ProductDiscount $product_discount)
    {
        return view('products.products-discount.edit', compact('product_discount'));
    }

    // Función que actualiza el registro en la BD
    public function update(Request $request, ProductDiscount $product_discount)
    {
        // Validación de los campos recibidos
        $request->validate([
            'product_id'            => 'required|unique:product_discounts,product_id,' .$product_discount->id,
            'discount_start_date'   => 'required',
            'discount_end_date'     => 'required|after_or_equal:discount_start_date',
            'percentage'            => 'required',
            'discount'              => 'required',           
        ], [
            'product_id.required'           => __('The product is required'),
            'product_id.unique'             => __('The selected product already has a discount'),
            'discount_start_date.required'  => __('The discount start date is required'),
            'discount_end_date.required'    => __('The discount end date is required'),
            'percentage.required'           => __('The percentage is required'),
            'discount.required'             => __('The discount is required')
        ]);

        try {
           
            $data = [
                'product_id'            => $request->product_id,
                'discount_start_date'   => $request->discount_start_date,
                'discount_end_date'     => $request->discount_end_date,
                'percentage'            => $request->percentage,
                'discount'              => $request->discount,
                'status'                => $request->status ? 'ACTIVO' : 'INACTIVO',
                'id_user_updated'       => Auth::user()->id,
                'updated_at'            => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_by'            => Auth::user()->name
            ];

            // Actualiza el registro en la BD
            $product_discount->update($data);

            // Alerta de exito
            $notification = array(
                'message' => __('Product discount updated!'),
                'alert-type' => 'success'
            );
            // Retorna a la vista
            return redirect()->route('products.discount.index')->with($notification);
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
    public function destroy(ProductDiscount $product_discount)
    {
        try {
            // Prepara los datos a actualizar
            $data = [
                'status' => 'INACTIVO',
                'id_user_updated' => Auth::user()->id,
                'updated_by' => Auth::user()->name,
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
            ];
            // Actualiza el registro a borrado.
            $product_discount->update($data);
            return __('Record disabled!');
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }

    public function searchProducts(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%'.$request->input('term', '').'%')
        ->get(['id', 'name as text', 'thumbnail']);
        return ['results' => $products];
    }

    public function getProduct(Request $request)
    {
        $product = Product::where('id',$request->input('product_id'))->first(['price', 'name', 'id']);
        return $product;
    }
}
