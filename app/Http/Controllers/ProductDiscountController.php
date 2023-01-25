<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDiscount;
use App\Models\Product;
use Illuminate\Support\Facades\Response;

class ProductDiscountController extends Controller
{
    // Función que retorna todos los productos con descuento al index.
    public function index()
    {
        // Obtengo todos los registros de la BD ordenados por el más reciente.
        $products_discount = ProductDiscount::orderBy('updated_at', 'DESC')
            ->get();

        return Response::json([
            'data' => $products_discount
        ]);
    }

    // Función que redirecciona a la vista create
    public function create()
    {

        $productos = Product::where('validity', '=', 'ACTIVO')->get();

        return view('products.products-discount.create', [
            "productos" => $productos
        ]);
    }
}
