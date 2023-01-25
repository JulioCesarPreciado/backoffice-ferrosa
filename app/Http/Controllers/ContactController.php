<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function update(Request $request)
    {

        $request->validate([
            'company_name' => 'required'
        ]);


        try {
            $request->request->add(['updated_by' => Auth::user()->name]); //add request
            // Actualiza en la BD
            Contact::first()->update($request->all());

            // Alerta de exito
            $notification = array(
                'message' => __('Data Updated'),
                'alert-type' => 'success'
            );
            // Retornamos a la vista
            return redirect()->route('configs.index')->with($notification);
        } catch (Exception $e) {
            // Alerta de error

            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            // Retornamos a la vista
            return redirect()->route('configs.index')->with($notification);
        }
    }


}
