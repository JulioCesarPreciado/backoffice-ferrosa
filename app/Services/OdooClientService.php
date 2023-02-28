<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Response;
use Ripcord\Ripcord;

// Más información sobre service pattern
// https://blackdeerdev.com/laravel-services-pattern/
// https://dev.to/safbalili/implement-crud-with-laravel-service-repository-pattern-1dkl
// https://cosasdedevs.com/posts/crud-api-laravel-8-parte-1-modelos-creacion/

class OdooClientService extends BaseClientService
{
    // Constructor
    public function __construct()
    {
        // Variables para acceder al entorno de ferrosa obtenidas desde el .env
        $this->url = env('ODOO_URL', null);
        $this->db = env('ODOO_DB', null);
        $this->username = env('ODOO_USERNAME', null);
        $this->password = env('ODOO_PASSWORD', null);
        // Iniciando sesión
        $common = Ripcord::client($this->url . "/xmlrpc/2/common");
        // Logueo con las variables de acceso y regresa Id del usuario logeado si todo salio bien
        $this->uid = $common->authenticate($this->db, $this->username, $this->password, []);
        // Conexión a los objetos de Odoo
        $this->models = Ripcord::client($this->url . "/xmlrpc/2/object");
    }

    // Función que retorna todos los productos
    public function getAllProducts()
    {
        try {
            // Si todo sale bien
            $result['status'] = Response::HTTP_OK;
            // Busqueda hecha en la tabla de productos de Odoo. Todos los productos
            $result['data'] = $this->models->execute_kw(
                $this->db,
                $this->uid,
                $this->password,
                'product.template',
                'search_read',
                [[['categ_id', '!=', 1], ['default_code', '!=', false], ['image_1920', '!=', false]]],
                [
                    'fields' => ['id', 'name', 'list_price', 'categ_id', 'default_code', 'image_1920'],
                    //'limit' => 5 // Quitar esto para traer todo
                ]
            );
        } catch (Exception $e) {
            // Si ocurre algún error
            $result['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $result['error'] = $e->getMessage();
        }
        return response()->json($result);
    }

    // Función que retorna un producto
    public function getProduct($product_id)
    {
        try {
            // Busqueda hecha en la tabla de productos de Odoo. Un producto por id
            $result = $this->models->execute_kw(
                $this->db,
                $this->uid,
                $this->password,
                'product.template',
                'search_read',
                [[['categ_id', '!=', 1], ['default_code', '!=', false], ['id', '=', $product_id]]],
                ['fields' => ['id', 'name', 'list_price', 'categ_id', 'default_code', 'image_1920', 'description']]
            )[0];
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }

    // Función que retorna todas las categorias de los productos
    public function getAllCategories()
    {
        try {
            // Si todo sale bien
            $result['status'] = Response::HTTP_OK;
            // Busqueda hecha en la tabla de productos de Odoo. Todos los productos
            $result['data'] = $this->models->execute_kw(
                $this->db,
                $this->uid,
                $this->password,
                'product.category',
                'search_read',
                [],
                [
                    'fields' => ['id', 'name', 'display_name'],
                ]
            );
        } catch (Exception $e) {
            // Si ocurre algún error
            $result['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $result['error'] = $e->getMessage();
        }
        return response()->json($result);
    }

    // Función que retorna el stock de un producto
    public function getProductStockQty($product_id)
    {
        try {
            // Si todo sale bien
            $result['status'] = Response::HTTP_OK;
            // Busqueda hecha en la tabla de productos de Odoo. Un producto por id
            $result['data'] = $this->models->execute_kw(
                $this->db,
                $this->uid,
                $this->password,
                'product.template',
                'search_read',
                [[['categ_id', '!=', 1], ['default_code', '!=', false], ['id', '=', $product_id]]],
                [
                    'fields' => ['qty_available']
                ]
            );
        } catch (Exception $e) {
            // Si ocurre algún error
            $result['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $result['error'] = $e->getMessage();
        }
        return response()->json($result);
    }

    // Función que retorna el stock de un producto
    public function getTrendingProducts()
    {
        try {
            // Busqueda hecha en la tabla de productos de Odoo. Un producto por id
            $result = $this->models->execute_kw(
                $this->db,
                $this->uid,
                $this->password,
                'product.template',
                'search_read',
                [[['categ_id', '!=', 1], ['default_code', '!=', false], ['id', '<', 31502]]],
                ['fields' => ['id', 'name', 'list_price', 'categ_id', 'default_code', 'image_1920', 'description', 'description_purchase', 'description_sale', 'volume', 'weight', 'color']]
            );
        } catch (Exception $e) {
            // Si ocurre algún error
            $result = $e->getMessage();
            //TO-DO Guardar este error en un log
        }
        return $result;
    }

    // Función para guardar todos los productos en la db
    public function storeProducts()
    {
        ini_set('max_execution_time', 1200);
        try {
            // Busqueda hecha en la tabla de productos de Odoo. Un producto por id
            /*
                REMOVER LO DE LOS IDS
            */
            /* */

            $ids = $this->models->execute_kw(
                $this->db,
                $this->uid,
                $this->password,
                'product.template',
                'search',
                [[['categ_id', '!=', 1], ['default_code', '!=', false], ['image_1920', '!=', false]]],
                ['order' => 'id']
            );

            #Variable donde se guardará la cantidad de productos creados
            /*Id de la tarifa de precios */
            $products_created = 0;
            $id_price_list = $this->getPriceListId();
            $results = $this->getProductL1($id_price_list,$ids);
            #Recorremos los productos regresados por odoo para guardarlos en la base de datos.
            foreach ($results as $result) {

                #Obtemos el producto desde Odoo
                $product = $this->getProduct($result["product_tmpl_id"][0]);
                $price = $this->getPriceList($id_price_list,$product['id']);
                if (!Product::where('id', $product['id'])->exists()) {
                    #Lo guardamos en la base de datos
                    Product::create([
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'sku' => $product['default_code'],
                        'description' => $product['description'],
                        'price' => $price == null ?? 1 , $price ,//$product['list_price'],
                        'thumbnail' => $product['image_1920'],
                        'quantity' => rand(1, 200),
                        'purchases' => rand(1, 200),
                        'visits' => rand(1, 200),
                        'category' => $product['categ_id'][1],
                    ]);
                    #Actualizamos la cantidad de productos creado
                    $products_created++;

                }
            }
        } catch (Exception $e) {
            // Si ocurre algún error
            return Response::json(array(
                "mensaje"   => $e->getMessage(),
                "status"    => 500
            ), 500);
        }

        return Response::json(array(
            "mensaje"   => "Se crearon " . $products_created . " productos",
            "status"    => 200
        ), 200);

    }


    public function getProductL1 ($pricelist_id,$id){
        try {
            $results = $this->models->execute_kw(
                $this->db,
                $this->uid,
                $this->password,
                'product.pricelist.item',
                'search_read',
                [[['pricelist_id', '=', $pricelist_id],['product_tmpl_id', '!=',FALSE],['product_tmpl_id','in',$id]]],
                ['fields' => ['product_tmpl_id']]
            );

            return $results;
        } catch (Exception $e) {
            // Si ocurre algún error
            return $e->getMessage();
        }
    }
    public function getPriceListId()
    {
            try{
        $result = $this->models->execute_kw(
            $this->db,
            $this->uid,
            $this->password,
            'product.pricelist',
            'search_read',
            [[['active', '=', true],['name','=','L1']]],
            ['fields' => ['id', 'name']]
        );
            return $result[0]["id"];

        } catch (Exception $e) {
            // Si ocurre algún error
            return $e->getMessage();
        }
    }

    public function getPriceList($pricelist_id,$product_id){
        try{
            $result = $this->models->execute_kw(
                $this->db,
                $this->uid,
                $this->password,
                'product.pricelist.item',
                'search_read',
                [[['active', '=', true],['pricelist_id','=',$pricelist_id],['product_tmpl_id','=',$product_id]]],
                ['fields' => ['fixed_price']]
            );
                return $result[0]["fixed_price"];

            } catch (Exception $e) {
                // Si ocurre algún error
               // return $e->getMessage();
               return null;
            }
    }

    /**
     * Actualiza los datos del modelo seleccionado
     *
     * @param string name_model
     * @param int model_id
     * @param array data ('columna'=>valor)
     * @return bool
     */
    public function updateModel($name_model, $model_id, $data = [])
    {
        return $this->models->execute_kw(
            $this->db,
            $this->uid,
            $this->password,
            $name_model,
            'write',
            array(
                array($model_id),
                $data
            )
        );
    }

    /**
     * Devuelve un arreglo con datos del modelo seleccionado
     *
     * @param int id
     * @param string $model
     * @param array $where
     * @param array $fields
     * @return array
     */
    public function getDataById($model = null, $where = [], $fields = [])
    {
        return $this->models->execute_kw(
            $this->db,
            $this->uid,
            $this->password,
            $model,
            'search_read',
            [$where],
            ['fields' => $fields]
        );
    }

    /**
     * Función que actualiza el stock de productos en la base de datos
     *
     * @param Int $product_id - id del producto a actualizar
     * @param Int $qty - cantidad del stock que se va a reducir
     * @return String La nueva cantidad actualizada o mensaje de error en caso de no encontrar
     */
    public function updateProductStock($product_id = null, $qty = 0)
    {
        try {
            // Busca el id del stock
            $stock_location = $this->getStockID();

            // Busca el stock del producto dado
            $product_stock = $this->getProductStock($stock_location, $product_id);

            // Valida que de verdad haya encontrado el stock
            if ($product_stock == [])
                return 'Producto no encontrado.';

            // Resta el qty al stock del producto
            $new_stock = $product_stock['quantity'] - $qty;

            // Revisa si la nueva cantidad del stock es valida
            if ($new_stock < 0)
                return 'No hay suficientes productos.';

            // Actualiza el stock del producto
            $updated_stock = $this->updateStockQty($product_stock['id'], $new_stock);

            // Revisa si es booleano quiere decir que es true y se hizo el update,
            // si no retorna un array con el error
            return gettype($updated_stock) != 'boolean' ? $updated_stock : $new_stock;
        } catch (Exception $e) {
            // Si ocurre algún error
            return $e->getMessage();
        }
    }

    /**
     * Retorna el stock.location id que sirve para buscar en la tabla stock.quant
     *
     * @return Int Id del stock
     */
    public function getStockID()
    {
        try {
            // Busca el id del stock
            $stock_location = $this->getDataById(
                'stock.warehouse',
                [['name', '=', env('ODOO_STOCK_WAREHOUSE_NAME', null)]],
                ['lot_stock_id']
            );
            return $stock_location[0]['lot_stock_id'][0];
        } catch (Exception $e) {
            // Si ocurre algún error
            return $e->getMessage();
        }
    }

    /**
     * Retorna el stock para un producto
     *
     * @param Int $stock_location ID del stock
     * @param Int $product_id ID del producto
     * @return Array Vacio si no encontro nada o con id y quantity del stock del producto
     */
    public function getProductStock($stock_location, $product_id)
    {
        try {
            // Busca el stock del producto dado
            $product_stock = $this->getDataById(
                'stock.quant',
                [
                    ['location_id', '=', $stock_location],
                    ['product_id', '=', $product_id]
                ],
                ['quantity']
            );

            return $product_stock != [] ? $product_stock[0] : $product_stock;
        } catch (Exception $e) {
            // Si ocurre algún error
            return $e->getMessage();
        }
    }

    /**
     * Retorna el stock para un producto
     *
     * @param Int $product_id - ID del producto
     * @param Int $new_stock - La cantidad de stock con el producto ya reducido
     * @return True|Array True cuando se actualizo o el array con el mensaje de error
     */
    public function updateStockQty($product_id, $new_stock)
    {
        try {
            // Actualiza el stock del producto
            return $this->updateModel(
                'stock.quant',
                $product_id,
                [
                    'quantity' => $new_stock
                ]
            );
        } catch (Exception $e) {
            // Si ocurre algún error
            return $e->getMessage();
        }
    }
}
