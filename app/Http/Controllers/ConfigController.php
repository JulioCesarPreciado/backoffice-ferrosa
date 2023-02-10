<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Contact;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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

        //dd($request->all());

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
                //separamos la ruta por "/" para obtener el nombre de la imagen guardada
                $extension = explode('/', $setting->logo);
                //obtenemos el último parametro del array, que siempre va a ser el nombre de la imagen junto a su extensión
                $file_name = end($extension);

                //borramos la imagen del disco iconos, donde se guardan todas las imagenes de los iconos
                Storage::disk('iconos')->delete($file_name);
                // Lo guardamos
                Storage::putFileAs('upload/iconos/', $logo, $logo_name);
                // agrega al data la ruta del archivo
                $data['logo'] = env('APP_URL') . "/iconos/". $logo_name;
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
                //separamos la ruta por "/" para obtener el nombre de la imagen guardada
                $extension = explode('/', $setting->icon);
                //obtenemos el último parametro del array, que siempre va a ser el nombre de la imagen junto a su extensión
                $file_name = end($extension);

                //borramos la imagen del disco iconos, donde se guardan todas las imagenes de los iconos
                Storage::disk('iconos')->delete($file_name);
                // Lo guardamos
                Storage::putFileAs('upload/iconos/', $icon, $icon_name);
                // agrega al data la ruta del archivo
                $data['icon'] = env('APP_URL') . "/iconos/". $icon_name;
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
                //separamos la ruta por "/" para obtener el nombre de la imagen guardada
                $extension = explode('/', $setting->background);
                //obtenemos el último parametro del array, que siempre va a ser el nombre de la imagen junto a su extensión
                $file_name = end($extension);

                //borramos la imagen del disco iconos, donde se guardan todas las imagenes de los iconos
                Storage::disk('iconos')->delete($file_name);
                // Lo guardamos
                Storage::putFileAs('upload/iconos/', $background, $background_name);
                // agrega al data la ruta del archivo
                $data['background'] = env('APP_URL') . "/iconos/". $background_name;
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
