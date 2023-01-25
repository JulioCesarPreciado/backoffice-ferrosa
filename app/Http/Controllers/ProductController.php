<?php

namespace App\Http\Controllers;

use App\Services\OdooClientService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $odoo_client_service;

    // Constructor
    public function __construct(OdooClientService $odoo_client_service)
    {
        $this->odoo_client_service = $odoo_client_service;
    }

    // Función que retorna todos los productos
    public function index()
    {
        return $this->odoo_client_service->getAllProducts();
    }

    // Función que retorna un producto en base a su id
    public function show($product_id)
    {
        return $this->odoo_client_service->getProduct($product_id);
    }

    // Función que retorna todas las categorias de los productos
    public function getAllCategories()
    {
        return $this->odoo_client_service->getAllCategories();
    }

    // Función que retorna el stock de un producto
    public function getProductStockQty($product_id)
    {
        return $this->odoo_client_service->getProductStockQty($product_id);
    }

    //Función que retorna los productos en tendencia
    public function getTrendings()
    {
        return $this->odoo_client_service->getTrendingProducts();
    }

    //Función que guarda productos en la base de datos
    public function storeProducts()
    {
        return $this->odoo_client_service->storeProducts();
    }

    /**
     * Función que actualiza el stock de cada producto en la base de datos
     *
     * @param Request $request - contiene un array asociativo llamado 'products'
     * donde cada elemento posee los llaves 'id' y 'qty'
     * @return Array Donde cada elemento posee el id del producto que se actualizo y la
     * respuesta obtenida del odooClientService
     */
    public function updateProductsStocks(Request $request)
    {
        $updateResults = [];

        foreach ($request->products as $product) {
            array_push($updateResults, [
                'product_id' => $product['id'],
                'response' => $this->odoo_client_service->updateProductStock($product['id'], $product['qty'])
            ]);
        }

        return $updateResults;
    }
}
