<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido a Coordify</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; color: #1c1c1c;">
  <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">
    
    <div style="background-color: #ffffff; padding-top: 30px; text-align: center;">
      <img src="https://coordify.logannr.me/img/logos/coordify.png" alt="Coordify" width="250" style="display: block; margin: 0 auto;">
    </div>

    <div style="padding: 20px;">
      <h1 style="font-size: 24px; margin-bottom: 10px;">¡Hola {{ $user->name }}!</h1>
      <p style="font-size: 16px; line-height: 1.6; margin: 0 0 15px;">Gracias por registrarte en <strong>Coordify</strong>. Estás a un paso de descubrir, crear y coordinar eventos como un profesional.</p>
      <p style="font-size: 16px; line-height: 1.6; margin: 0 0 30px;">Desde talleres y conciertos hasta eventos corporativos o de bienestar, Coordify te ayuda a organizarlos fácilmente y conectar con tu audiencia.</p>

      <a href="{{ url('https://coordify.logannr.me') }}" style="display: inline-block; padding: 12px 24px; background-color: #0f9d58; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: bold;">Empieza a coordinar</a>
    </div>

    <div style="padding: 20px; text-align: center; font-size: 13px; color: #777;">
      © {{ now()->year }} Coordify. Todos los derechos reservados.
    </div>

  </div>
</body>
</html>
