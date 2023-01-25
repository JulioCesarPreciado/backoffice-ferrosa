<?php

// Función que guarda una imagen de una url, requiere allow_url_fopen = true

use Carbon\Carbon;

function saveImageFromUrlOld($url = 'https://thispersondoesnotexist.com/image', $file_name = 'image', $path = 'storage/upload/url_images/', $width = 100, $height = 100)
{
    createDirectory($path);
    $file_extension = '.jpg';
    $file_name = $file_name . $file_extension;
    $path = public_path($path) . $file_name;

    // Obtengo la imagen de internet y la guardo
    file_put_contents($path, file_get_contents($url));

    // Retorno el nombre
    return $file_name;
}

// Función que guarda una imagen de una url, usa curl
function saveImageFromUrl($url = 'https://thispersondoesnotexist.com/image', $file_name = 'image', $path = 'storage/upload/url_images/', $width = 100, $height = 100)
{
    //Revisa si el directorio existe, si no lo crea
    createDirectory($path);

    $file_extension = '.jpg';
    $file_name = $file_name . $file_extension;
    $path = public_path($path) . '/' . $file_name;

    // Obtengo la imagen de internet y la guardo
    $ch = curl_init($url);
    $fp = fopen($path, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);

    // Retorno el nombre
    return $file_name;
}

// Función que revisa si el directorie existe y si no lo crea
function createDirectory($path)
{
    $path = public_path($path);
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
}

// Función que elimina todas las imagenes de un directorio
// (Principalmente usado en seeders)
function deleteImagesFromDirectory($path = 'storage/upload/url_images/')
{
    $path = public_path($path);
    // Obtiene archivos que pueda haber en la ruta
    $files = glob($path . '*');
    // Recorre lso archivos
    foreach ($files as $file) {
        // Revisa si es un archivo y si sí lo elimina
        if (is_file($file))
            unlink($file);
    }
}

//Función para obtener el full path
function fullPath(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

// Función para guardar o actualizar un archivo en el server()
function saveOrUpdateFile($file = null, $prefix = 'file', $path = 'storage/upload/files/', $old_file_name = null)
{
    // Establezco la zona horaria por defecto
    date_default_timezone_set('America/Mexico_City');

    //Revisa si el directorio existe, si no lo crea
    createDirectory($path);

    // Se crea el nombre del archivo
    $file_name = date('YmdHi') . '_' . $prefix . '_' . $file->getClientOriginalName();
    // Se guarda en el server
    $file->move(public_path($path), $file_name);

    //Revisa si mando el nombre de un archivo anterior
    if ($old_file_name) {
        // Remuevo el archivo anterior
        removeImageFromDirectory($old_file_name);
    }

    // Retorno el nombre del archivo con ruta completa
    return fullPath() . '/' . $path . $file_name;
}

// Funcion que elimina la imagen dada
// parametro obtenido de ejemplo http://127.0.0.1:8000/storage/upload/newsletter/image.jpeg
function removeImageFromDirectory($file)
{
    // Deja solo la ruta desde el storage y el nombre del archivo
    $file = str_replace(fullPath(), '', $file);
    // Remueve la imagen
    @unlink(public_path($file));
}

//función que genera imagenes random de un servidor de imagenes random
function generateImagesRandom($names){
    //la url donde se van a descargar imagenes
    $url = "https://api.lorem.space/image/face?w=1704&h=726";
    //se obtiene su contenido
    $contents = file_get_contents($url);
    //se crea el nombre de la imagen junto con su extensión
    $file_name = $names . ".png";
    //guardo la imagen generada en el disco "banners", que apunta a la ruta /upload/banner dentro del storage
    Storage::disk('banners')->put($file_name, $contents);

    //retorno el nombre del archivos
    return $file_name;
}
