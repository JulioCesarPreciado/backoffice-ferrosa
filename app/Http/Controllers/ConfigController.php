<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Contact;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ConfigController extends Controller
{
    //

    public function index()
    {
        // Obtengo todos los registros
        $configs = Config::first();
        $contact = Contact::first();

        return view('site_settings.config.index',  compact('configs', 'contact'));
    }

    // Función que actualiza el registro en la BD
    // public function updateSiteSettings(Request $request, Config $config)
    public function updateSiteSettings(Request $request)
    {
        // Validamos los campos enviados
        $request->validate([
            'name' => 'required',
        ]);

        try {
            // Guardamos los datos a crear
            $data = ([
                'name' => $request->name,
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_by' => Auth::user()->name,
            ]);
            //  ################## LOGO ##################
            // // Obtenemos el archivo del request
            $logo = $request->file('logo_path');

            // Revisa si se modifico la imagen
            if (isset($logo)) {
                // Creamos el nombre del archivo
                $logo_name = date('YmdHi') . '_logo_' . $logo->getClientOriginalName();

                // Obtengo el registro de la bd para obtener el logo anterior
                $setting = Config::first();
                // Borramos la foto anterior
                @unlink(public_path('storage/upload/site_setting/' . $setting->logo));
                // Lo guardamos
                $logo->move(public_path('storage/upload/site_setting'), $logo_name);
                #Generamos el path donde se guardará
                $logo_name = fullPath() . "/storage/upload/site_setting/" . $logo_name;
                // agrega al data el nombre del archivo
                $data['logo'] = $logo_name;
            }
            // ################## END LOGO ##################
            // ################## ICONO ##################
            // // Obtenemos el archivo del request
            $icon = $request->file('icon_path');
            // Revisa si se modifico la imagen
            if (isset($icon)) {
                // Creamos el nombre del archivo
                $icon_name = date('YmdHi') . '_icon_' . $icon->getClientOriginalName();
                // Obtengo el registro de la bd para obtener el icono anterior
                $setting = Config::first();
                // Borramos la foto anterior
                @unlink(public_path('storage/upload/site_setting/' . $setting->icon));
                // Lo guardamos
                $icon->move(public_path('storage/upload/site_setting'), $icon_name);

                $icon_name = fullPath() . "/storage/upload/site_setting/" . $icon_name;
                // agrega al data el nombre del archivo
                $data['icon'] = $icon_name;
            }
            // ################## END ICONO ##################

            // ################## BACKGROUND ##################
            // // Obtenemos el archivo del request
            $background = $request->file('background_path');

            // Revisa si se modifico la imagen
            if (isset($background)) {
                // Creamos el nombre del archivo
                $background_name = date('YmdHi') . '_background_' . $background->getClientOriginalName();

                // Obtengo el registro de la bd para obtener el background anterior
                $setting = Config::first();
                // Borramos la foto anterior
                @unlink(public_path('storage/upload/site_setting/' . $setting->background));
                // Lo guardamos
                $background->move(public_path('storage/upload/site_setting'), $background_name);

                // agrega al data el nombre del archivo
                $data['background'] = fullPath() . "/storage/upload/site_setting/" . $background_name;
            }
            // ################## END BACKGROUND ##################
            //  ################## COLOR ##################
            // // Obtenemos el archivo del request
            $color = $request->input('color');
            // agrega al data el nombre del archivo
            $data['color'] = $color;
            // ################## END COLOR ##################
            //  ################## SHADE ##################
            // // Obtenemos el archivo del request
            $shade = $request->input('shade');
            // agrega al data el nombre del archivo
            $data['shade'] = $shade;
            // ################## END SHADE ##################
            // Actualiza en la BD
            Config::first()->update($data);
            // Alerta de exito
            $notification = array(
                'message' => 'Registro actualizado!',
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
