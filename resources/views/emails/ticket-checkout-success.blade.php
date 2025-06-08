<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Entrada confirmada - Coordify</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; color: #1c1c1c;">
  <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">

    <div style="background-color: #ffffff; padding: 30px 0; text-align: center;">
      <img src="https://coordify.logannr.me/img/logos/coordify.png" alt="Coordify" width="180" style="display: block; margin: 0 auto;">
    </div>

    <div style="padding: 30px;">
      <h1 style="font-size: 22px; margin-bottom: 15px;">🎉 ¡Gracias por tu compra, {{ $participant->name }}!</h1>

      <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
        Tu entrada para el evento <strong>{{ $event->name }}</strong> ha sido confirmada. A continuación te dejamos tu código QR. Guárdalo y preséntalo el día del evento.
      </p>

      <div style="text-align: center; margin: 25px 0;">
        <img src="https://coordify.logannr.me/storage/{{ $participant->qr_code }}" alt="Código QR de tu entrada" style="width: 200px; border-radius: 8px;">
      </div>

      <table style="width: 100%; font-size: 15px; color: #333; margin-bottom: 25px;">
        <tr>
          <td style="padding: 6px 0;"><strong>Ubicación:</strong></td>
          <td style="padding: 6px 0;">
            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->address . ', ' . $event->community) }}" target="_blank" style="text-decoration: underline;">
              {{ $event->address }}, {{ $event->community }}
            </a>
          </td>
        </tr>
        <tr>
          <td style="padding: 6px 0;"><strong>Fecha:</strong></td>
          <td style="padding: 6px 0;">
            {{ date('d/m/Y', strtotime($event->startDate)) }}
            {{ $event->startTime ? ' - ' . date('H:i', strtotime($event->startTime)) : '' }}
          </td>
        </tr>
        <tr>
          <td style="padding: 6px 0;"><strong>Email:</strong></td>
          <td style="padding: 6px 0;">{{ $participant->email }}</td>
        </tr>
      </table>

      <div style="text-align: center; margin: 30px 0;">
        <a href="https://coordify.logannr.me/events/view/{{ $event->id }}" style="display: inline-block; background-color: #0f9d58; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold;">
          Ver evento
        </a>
      </div>

      <p style="font-size: 14px; line-height: 1.6; color: #777; text-align: center;">
        Puedes mostrar el código QR desde tu móvil o llevarlo impreso. ¡Nos vemos pronto!
      </p>
    </div>

    <div style="padding: 20px; text-align: center; font-size: 13px; color: #999;">
      © {{ now()->year }} Coordify. Todos los derechos reservados.
    </div>

  </div>
</body>
</html>
