<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OdooProductController extends Controller
{
    public function index()
    {
        return view('products.odoo-products.index');
    }
}
