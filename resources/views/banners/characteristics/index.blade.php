<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En mantenimiento</title>
    <style>
      /* Estilos CSS para la plantilla */
      body {
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
        line-height: 1.5;
        color: #333;
      }
      .container {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        padding: 50px;
      }
      h1 {
        font-size: 48px;
        margin-bottom: 20px;
      }
      p {
        font-size: 24px;
        margin-bottom: 30px;
      }
      .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
      }
      .btn:hover {
        background-color: #666;
      }
      .timer {
        font-size: 36px;
        margin-bottom: 40px;
      }
      .timer span {
        font-size: 24px;
        margin-left: 10px;
      }
    </style>
    <script>
      // JavaScript para el temporizador de cuenta regresiva
      var countDownDate = new Date("Mar 6, 2023 9:00:00").getTime();
      var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("timer").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("timer").innerHTML = "FINALIZADO";
        }
      }, 1000);
    </script>
  </head>
  <body>
    <div class="container">
      <h1>Estamos en mantenimiento</h1>
      <p>Lamentamos las molestias. Actualmente estamos realizando algunas actualizaciones en nuestro sitio web. Por favor, vuelve más tarde.</p>
      <div class="timer">Volveremos en <span id="timer"></span></div>
      <a href="#" class="btn">Volver a intentarlo</a>
      <img src="imagen_en_mantenimiento.jpg" alt="Sitio web en mantenimiento">
    </div>
  </body>
</html>
