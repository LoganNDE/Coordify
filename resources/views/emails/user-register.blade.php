<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido a Coordify</title>
  <style>
    body {
      font-family: 'Segoe UI', Roboto, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      color: #1c1c1c;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
      overflow: hidden;
    }
    .header {
      background-color: #ffffff;
      padding: 30px;
      max-width: 600px;
      text-align: center;
    }
    .logo {
      font-size: 28px;
      font-weight: bold;
      color: #0f9d58;
    }
    .content {
      padding: 30px;
    }
    .content h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }
    .content p {
      font-size: 16px;
      line-height: 1.6;
    }
    .cta {
      margin-top: 30px;
      display: inline-block;
      padding: 12px 24px;
      background-color: #0f9d58;
      color: #ffffff;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
    }
    .footer {
      padding: 20px;
      text-align: center;
      font-size: 13px;
      color: #777;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="logo"><img src="{{ asset('img/logos/coordify.svg') }}" alt="Coordify"></div>
    </div>
    <div class="content">
      <h1>¡Hola {{ $user->name }}!</h1>
      <p>Gracias por registrarte en <strong>Coordify</strong>. Estás a un paso de descubrir, crear y coordinar eventos como un profesional.</p>
      <p>Desde talleres y conciertos hasta eventos corporativos o de bienestar, Coordify te ayuda a organizarlos fácilmente y conectar con tu audiencia.</p>

      <a href="{{ url('https://coordify.logannr.me') }}" class="cta">Empieza a Coordinar</a>
    </div>
    <div class="footer">
      © {{ now()->year }} Coordify. Todos los derechos reservados.
    </div>
  </div>
</body>
</html>
