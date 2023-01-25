<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMail;
use App\Models\Config;
use App\Models\Newsletter;
use App\Models\NewsletterUser;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

use function GuzzleHttp\Promise\all;

class NewsletterController extends Controller
{
    // Función que retorna todos los registros al index.
    public function index()
    {
        // Obtengo todos los registros de la BD ordenados por el más reciente.
        $newsletters = Newsletter::orderBy('validity', 'asc')
            ->orderBy('updated_at', 'desc')
            ->get();

        return Response::json([
            'newsletters' => $newsletters
        ]);
    }

    // Función que redirecciona a la vista create
    public function create()
    {
        return view('newsletters.create');
    }

    // Función que almacena el nuevo registro en la BD
    public function store(Request $request)
    {
        // Validación de los campos recibidos
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|file',
        ]);

        try {
            $file = saveOrUpdateFile(
                $request->file('content'),
                'newsletter',
                'storage/upload/newsletter/'
            );
            // Remuevo inputs no necesarios
            $request->request->remove('button_submit');

            // Agrego datos no obtenidos del request
            $request->request->add([
                'validity' => $request->validity ? 'ACTIVO' : 'INACTIVO',
                'id_user_created' => Auth::user()->id,
                'id_user_updated' => Auth::user()->id,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
                'created_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
            ]);

            // copio todo lo del request excepto el objeto del archivo a un array
            $data = $request->except(['content']);
            // agrego el nombre que contendria el archivo al array
            $data = array_merge($data, ['content' => $file]);

            // Inserta el nuevo registro a la BD
            Newsletter::create($data);

            // Alerta de exito
            $notification = array(
                'message' => __('Record created!'),
                'alert-type' => 'success'
            );
            // Retorna a la vista
            return redirect()->route('newsletters.index')->with($notification);
        } catch (QueryException $e) {
            // Alerta de error
            $notification = array(
                'message' =>  $e->errorInfo[2],
                'alert-type' => 'error'
            );
            // Retorna a la vista
            return redirect()->back()->with($notification);
        }
    }

    // Función que manda a la vista show
    public function show(Newsletter $newsletter)
    {
        return view('newsletters.show', compact('newsletter'));
    }

    // Función que manda a la vista edit
    public function edit(Newsletter $newsletter)
    {
        return view('newsletters.edit', compact('newsletter'));
    }

    // Función que actualiza el registro en la BD
    public function update(Request $request, Newsletter $newsletter)
    {
        // Validación de los campos recibidos
        $request->validate([
            'title' => 'required|string',
            'content' => 'file',
        ]);

        try {
            // Remuevo inputs no necesarios
            $request->request->remove('button_submit');

            // Agrego datos no obtenidos del request
            $request->request->add([
                'validity' => $request->validity ? 'ACTIVO' : 'INACTIVO',
                'id_user_updated' => Auth::user()->id,
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City'),
                'updated_by' => Auth::user()->name
            ]);

            // Preparo los datos a actualizar
            // copio todo lo del request excepto el objeto del archivo a un array
            $data = $request->except(['content']);

            // Revisa si hay imagen en el request y pone la nueva, si no deja la que estaba
            if ($request->hasFile('content')) {
                // Guardo el nuevo archivo y obtengo su nombre y ruta
                $file = saveOrUpdateFile(
                    $request->file('content'),
                    'newsletter',
                    'storage/upload/newsletter/',
                    $newsletter->content
                );
            } else {
                $file = $newsletter->content;
            }

            // agrego el nombre que contendria el archivo al array
            $data = array_merge($data, ['content' => $file]);

            // Actualiza el registro en la BD
            $newsletter->update($data);

            // Alerta de exito
            $notification = array(
                'message' => __('Record updated!'),
                'alert-type' => 'success'
            );
            // Retorna a la vista
            return redirect()->route('newsletters.index')->with($notification);
        } catch (QueryException $e) {
            // Alerta de error
            $notification = array(
                'message' =>  $e->errorInfo[2],
                'alert-type' => 'error'
            );
            // Retorna a la vista
            return redirect()->back()->with($notification);
        }
    }

    // Función que elimina el registro de la BD
    public function destroy(Newsletter $newsletter)
    {
        try {
            // Prepara los datos a actualizar
            $data = [
                'validity' => 'INACTIVO',
                'id_user_updated' => Auth::user()->id,
                'updated_by' => Auth::user()->name,
                'updated_at' => Carbon::now()->setTimezone('America/Mexico_City')
            ];
            // Actualiza el registro a borrado.
            $newsletter->update($data);
            return __('Record disabled!');
        } catch (QueryException $e) {
            return $e->errorInfo[2];
        }
    }

    // Función que manda el correo con el newsletter
    public function sendNewsletterEmail(Newsletter $newsletter)
    {

        // Obtengo información del sitio
        $config = Config::select(
            'logo',
            'icon',
            'name',
        )->first();

        // Las guardo en un array asociativo
        $dataMail = [
            'logo' => $config->logo,
            'icon' => $config->icon,
            'company_name' => $config->name,
            'title' => $newsletter->title,
            'content' => $newsletter->content,
        ];

        try {

            // Obtengo todos los usuarios registrados y activos en el newsletter
            $newsletter_users = NewsletterUser::select('email')->where('validity', 'ACTIVO')->get();

            $recipients = [];
            // Recorro cada registro para obtener los emails de los destinatarios
            foreach($newsletter_users as $recipient){
                array_push($recipients, $recipient->email);
            }

            //Manda el correo a todos los destinatarios
            Mail::bcc($recipients)->send(new NewsletterMail($dataMail));

            // Actualiza el status del newsletter a enviado y el numero de enviados
            $newsletter->update([
                "status" => "ENVIADO",
                "sent" => count($recipients),
            ]);

            // Alerta de exito
            $notification = array(
                'message' => __('Newsletter sent'),
                'alert-type' => 'success'
            );
            // Retorna a la vista
            return redirect()->route('newsletters.index')->with($notification);
        } catch (QueryException $e) {
            // Alerta de error
            $notification = array(
                'message' =>  $e->errorInfo[2],
                'alert-type' => 'error'
            );
            // Retorna a la vista
            return redirect()->back()->with($notification);
        }
    }
}
