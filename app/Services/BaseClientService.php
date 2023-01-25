<?php

namespace App\Services;

abstract class BaseClientService
{
    // Defino las funciones que va requerir cuando se extienda esta clase

    // Función que retorna todos los productos
    abstract public function getAllProducts();

    // Función que retorna un producto
    abstract public function getProduct($product_id);

    // Función que retorna todas las categorias de los productos
    abstract public function getAllCategories();

    // Función que retorna el stock de un producto
    abstract public function getProductStockQty($product_id);

    // Función que retorna el stock de un producto
    abstract public function storeProducts();
}
