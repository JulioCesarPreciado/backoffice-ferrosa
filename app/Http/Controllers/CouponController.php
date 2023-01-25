<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;



class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('coupons.index');
    }

    //Función para la funcionalidad de los filtros en el grid.
    public function filter(Request $request)
    {
        //Obtenemos los registros con la información filtrada.
        return Coupon::select(
            'id',
            'name',
            'discount',
            'qty',
            'initial_date',
            'final_date',
            'status',
            'updated_at',
            'updated_by'
        )->Where('name', 'like', '%' . $request->filter["name"] . '%')
            ->Where('discount', 'like', '%' . $request->filter["discount"] . '%')
            ->Where('qty', 'like', '%' . $request->filter["qty"] . '%')
            ->Where('status', 'like', '%' . $request->filter["status"] . '%')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validamos el request para que todos los datos estén correctos en la función store.
        $validador = Validator::make($request->all(), [
            'obj'               => 'required',
            'obj.name'          => 'required|max:255|unique:coupons,name',
            'obj.discount'      => 'required|numeric|max:100',
            'obj.qty'           => 'required|numeric',
            'obj.initial_date'  => 'required|date',
            'obj.final_date'    => 'required|date|after_or_equal:obj.initial_date',
        ], [
            "obj.final_date.after_or_equal"     => __('The start date must be greater than the end date'),
            "obj.name.unique"                   => __('Coupon name already exists')
        ]);

        if ($validador->fails()) {
            return Response::json(array(
                "mensaje"  => $validador->errors(),
            ), 400);
        }
        //Obtenemos el objeto dentro del request.
        $request =  (object) $request->obj;
        try {
            $data = ([
                "name"            =>  $request->name,
                "discount"        =>  $request->discount,
                "qty"             =>  $request->qty,
                "initial_date"    =>  $request->initial_date,
                "final_date"      =>  $request->final_date,
                "status"          =>  $request->status,
                "validity"        =>  $request->status,
                'id_user_created' => Auth::user()->id,
                'id_user_updated' => Auth::user()->id,
                'created_by'      => Auth::user()->name,
                'updated_by'      => Auth::user()->name,
                'updated_at'      => Carbon::now()->setTimezone('America/Mexico_City'),
                'created_at'      => Carbon::now()->setTimezone('America/Mexico_City')
            ]);

            //Actualizamos el registro.
            $coupon = Coupon::create($data);

            //Retornamos el registro que se creo.
            return $this->return_record($coupon->id);
        } catch (QueryException $e) {

            return Response::json(array(
                "error" => $e,
                'mensaje' =>  $e->errorInfo[2],
            ), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request $request
     * @param  \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //validamos el request para que todos los datos estén correctos en la función.
        $validador = Validator::make($request->all(), [
            'obj'               => 'required',
            'obj.name'          => 'required|max:255|unique:coupons,name,' .$coupon->id,
            'obj.discount'      => 'required|integer',
            'obj.qty'           => 'required|integer',
            'obj.initial_date'  => 'required|date',
            'obj.final_date'    => 'required|date|after_or_equal:obj.initial_date',
        ],[
            "obj.final_date.after_or_equal"     => __('The start date must be greater than the end date'),
            "obj.name.unique"                   => __('Coupon name already exists')
        ]);

        if ($validador->fails()) {
            return Response::json(array(
                "mensaje"  => $validador->errors(),
            ), 400);
        }
        //Obtenemos el objeto dentro del request.
        $request =  (object) $request->obj;
        try {
            $data = ([
                "name"     =>  $request->name,
                "discount" =>  $request->discount,
                "qty"      =>  $request->qty,
                "initial_date" =>  $request->initial_date,
                "final_date"   =>  $request->final_date,
                "status"   =>  $request->status,
                "validity"   =>  $request->status,
                'id_user_updated' => Auth::user()->id,
                'updated_by'   => Auth::user()->name,
                'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
                'created_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
            ]);

            //Actualizamos el registro.
            $coupon->update($data);
            //Retornamos el objeto actualizado.
            return $this->return_record($coupon->id);
        } catch (QueryException $e) {

            return Response::json(array(
                "error" => $e,
                'mensaje' =>  $e->errorInfo[2],
            ), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        try {
            //array con la información a modificar para poner "cancelado" el registro.
            $data = ([
                'status'            => "INACTIVO",
                'validity'          => "INACTIVO",
                "id_user_updated"   => Auth::user()->id,
                'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_by'        => Auth::user()->name,
            ]);

            //Actualizamos el registro.
            $coupon->update($data);
            //Retornamos el objeto actualizado.
            return $this->return_record($coupon->id);
        } catch (QueryException $e) {

            return Response::json(array(
                "error" => $e,
                'mensaje' =>  $e->errorInfo[2],
            ), 500);
        }
    }

    // Esta funcion retorna un formato que acepta el grid al momento de ejecutar los eventos insert,update,delete.
    public function return_record($id)
    {
        return Coupon::select('id', 'name', 'discount', 'qty', 'initial_date', 'final_date', 'status', 'updated_at', 'updated_by')->where("id", "=", $id)->first();
    }
}
