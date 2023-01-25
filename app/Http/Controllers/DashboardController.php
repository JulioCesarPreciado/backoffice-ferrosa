<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
          // Obtengo todos los registros de la BD ordenados por el más reciente.
          $recent = Orders::orderBy('validity', 'asc')
          ->orderBy('updated_at', 'desc')
          ->get();

        // Obtengo todos los registros del dia
        $daily = Orders::whereDate('created_at', Carbon::now()->toDateString())->sum('total');

        // Obtengo todos los registros del mes
        $monthly = Orders::whereMonth('created_at', Carbon::now()->month)->sum('total');

        // Obtengo todos los registros del anio
        $yearly = Orders::whereYear('created_at', Carbon::now()->year)->sum('total');

        // Obtengo todos los registros pendientes
        $pending = Orders::where('validity', "ACTIVO")->count();

        return ['recent' => $recent, 'daily' => $daily, 'monthly' => $monthly, 'yearly' => $yearly, 'pending' => $pending];
    }
}
