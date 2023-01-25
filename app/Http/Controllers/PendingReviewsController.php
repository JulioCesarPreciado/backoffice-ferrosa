<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendingReviewsController extends Controller
{

    //Función para la funcionalidad de los filtros en el grid.
    public function filter(Request $request)
    {
        //Obtenemos los registros con la información filtrada.
        return Reviews::join('products', 'products.id', 'product_id')->select(
            'reviews.id',
            'reviews.title',
            'reviews.message',
            'reviews.name as reviews_name',
            'products.name as products_name',
            'reviews.validity',
            'reviews.updated_at',
            'reviews.updated_by'
        )
            ->Where('reviews.title', 'like', '%' . $request->filter['title'] . '%')
            ->Where('reviews.message', 'like', '%' . $request->filter['message'] . '%')
            ->Where('reviews.validity', 'PENDING')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reviews $pendingreview)
    {

        //Obtenemos el objeto dentro del request.
        $request = $request->obj;

        //Agregamos los datos extras al array data.
        $data = ([
            'status'           => 'EDITADO DESDE SISTEMA',
            'validity'          => $request["validity"],
            "id_user_updated"   => Auth::user()->id,
            'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_by'        => Auth::user()->name,
        ]);
        //Actualizamos el registro.
        $pendingreview->update($data);
        //Retornamos el objeto actualizado.
        return $this->return_record($pendingreview->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reviews $pendingreview)
    {
        //array con la información a modificar para poner "cancelado" el registro.
        $data = ([
            'validity'          => "RECHAZADO",
            "id_user_updated"   => Auth::user()->id,
            'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_by'        => Auth::user()->name,
        ]);
        //Actualizamos el registro.
        $pendingreview->update($data);
        //Retornamos el objeto actualizado.
        return $this->return_record($pendingreview->id);
    }

    // Esta funcion retorna un formato que acepta el grid al momento de ejecutar los eventos insert,update,delete.
    public function return_record($id)
    {
        return Reviews::join('products', 'products.id', 'product_id')->select('reviews.id', 'reviews.title', 'reviews.message', 'products.name as products_name', 'reviews.name as reviews_name', 'reviews.updated_at', 'reviews.validity')->where("reviews.id", "=", $id)->first();
    }
}
