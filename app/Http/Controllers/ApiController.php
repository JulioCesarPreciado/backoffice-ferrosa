<?php

namespace App\Http\Controllers;
use App\Models\Api;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function index(){

        return view('apis.index');
    }

    //Función para la funcionalidad de los filtros en el grid.
    public function filter(Request $request)
    {
        //Obtenemos los registros con la información filtrada.
        return Api::select(
            'id',
            'name',
            'public_key',
            'private_key',
            'id_platform',
            'email',
            'validity',
            'updated_at',
            'updated_by'
        )
             ->Where('name', 'like', '%' . $request->filter["name"]. '%')
             ->Where('token', 'like', '%' . $request->filter["token"]. '%')
            ->Where('email', 'like', '%' . $request->filter["email"]. '%')
            ->Where('id_platform', 'like', '%' . $request->filter["id_platform"]. '%')->get();

    }

    public function store(Request $request)
    {

        //recupero los datos del request, especificamente del atributo obj.
        $data = $request->obj;

        //creo un nuevo objeto del modelo con los datos del request y datos del usuario logeado
        $new_api = new Api([
            "name"                => $data["name"],
            "token"                => $data["token"],
            "public_key"                => $data["public_key"],
            "private_key"               =>  $data["private_key"],
            "id_platform"               =>  $data["id_platform"],
            "email"               =>  $data["email"],
            "validity"               =>  "ACTIVO",
            "id_user_created"       => Auth::user()->id,
            "created_by"            => Auth::user()->name,
            'updated_by'            => Auth::user()->name,
            "id_user_updated"       => Auth::user()->id,
        ]);

        //guardo el objeto creado del modelo
        $new_api->save();

        //retorno el id del objeto guardado en la bd.
        return $this->return_record($new_api->id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Api $api)
    {

        //Obtenemos el objeto dentro del request.
        $request = $request->obj;

        //Agregamos los datos extras al array data.
        $data = ([
            'name'          => $request["name"],
            'email'          => $request["email"],
            'token'          => $request["token"],
            'status'           => 'EDITADO DESDE SISTEMA',
            'public_key'          => $request["public_key"],
            'private_key'          => $request["private_key"],
            "id_user_updated"   => Auth::user()->id,
            'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_by'        => Auth::user()->name,
        ]);
        //Actualizamos el registro.
        $api->update($data);
        //Retornamos el objeto actualizado.
        return $this->return_record($api->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Api $api)
    {
        //array con la información a modificar para poner "cancelado" el registro.
        $data = ([
            'validity'          => "INACTIVE",
            "id_user_updated"   => Auth::user()->id,
            'updated_at'        => Carbon::now()->setTimezone('America/Mexico_City'),
            'updated_by'        => Auth::user()->name,
        ]);
        //Actualizamos el registro.
        $api->update($data);
        //Retornamos el objeto actualizado.
        return $this->return_record($api->id);
    }

    // Esta funcion retorna un formato que acepta el grid al momento de ejecutar los eventos insert,update,delete.
    public function return_record($id)
    {
        return Api::select('id','name','token', 'public_key', 'private_key', 'id_platform', 'email', 'updated_at', 'validity')->where("id", "=", $id)->first();
    }
}
