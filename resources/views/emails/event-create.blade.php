<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tu evento ha sido creado - Coordify</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; color: #1c1c1c;">
  <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">

    <div style="background-color: #ffffff; padding: 20px 0; text-align: center;">
      <img src="https://coordify.logannr.me/img/logos/coordify.png" alt="Coordify" width="180" style="display: block; margin: 0 auto;">
    </div>

    <div style="padding: 30px;">
      <h1 style="font-size: 22px; margin-bottom: 15px;">¡Has creado un nuevo evento!</h1>
      <p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;">Tu evento <strong>{{ $event->name }}</strong> ha sido creado con éxito. Aquí tienes un resumen de la información y un enlace para compartirlo fácilmente con tu audiencia:</p>

      <div style="text-align: center; margin: 25px 0;">
        <img src="{{ $event->image ? 'https://coordify.logannr.me/storage/' . $event->image : 'https://coordify.logannr.me/img/default-event.png' }}" alt="{{ $event->name }}" style="max-width: 100%; border-radius: 10px;">
      </div>

      <table style="width: 100%; font-size: 15px; color: #333; margin-bottom: 25px;">
        <tr>
          <td colspan="2" style="padding: 6px 0;">
            <strong>📍 Ubicación:</strong>
            <span style="margin-left: 6px;">
              <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->address . ', ' . $event->community) }}"
                target="_blank"
                style="color: #0f9d58; text-decoration: underline;">
                {{ $event->address }}, {{ $event->community }}
              </a>
            </span>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 6px 0;">
            <strong>📅 Fecha:</strong>
            <span style="margin-left: 6px;">
              {{ date('d/m/Y', strtotime($event->startDate)) }}
              {{ $event->startTime ? '- ' . date('H:i', strtotime($event->startTime)) : '' }}
              @if($event->endDate)
                <br>Hasta {{ date('d/m/Y', strtotime($event->endDate)) }}
                {{ $event->endTime ? '- ' . date('H:i', strtotime($event->endTime)) : '' }}
              @endif
            </span>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 6px 0;">
            <strong>📂 Categoría:</strong>
            <span style="margin-left: 6px;">
              @if($event->category)
                {{ ucfirst($event->category->name) }}
              @else
                Sin categoría
              @endif
            </span>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 6px 0;">
            <strong>👥 Participantes:</strong>
            <span style="margin-left: 6px;">{{ $event->participants->count() ?? 0 }}</span>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 6px 0;">
            <strong>💰 Precio:</strong>
            <span style="margin-left: 6px;">
              @if ($event->paymentType === 'free' || $event->price === null || $event->price == 0)
                Gratuito
              @else
                {{ number_format($event->price, 2) }} €
              @endif
            </span>
          </td>
        </tr>
      </table>


      <div style="text-align: center; margin-top: 20px;">
        <a href="https://coordify.logannr.me/events/view/ . {{ $event->id }}" style="display: inline-block; background-color: #0f9d58; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold;">
          Ver evento en Coordify
        </a>
      </div>

      <div style="margin-top: 25px;">
        <h2 style="font-size: 18px; margin-bottom: 10px;">📝 Descripción del evento</h2>
        <p style="font-size: 15px; line-height: 1.6; color: #333;">{{ $event->description }}</p>
      </div>

      <p style="font-size: 14px; line-height: 1.6; color: #777; margin-top: 30px;">Comparte este enlace en redes sociales, por WhatsApp o en tu web para que otros puedan unirse a tu evento.</p>
    </div>

    <div style="padding: 20px; text-align: center; font-size: 13px; color: #999;">
      © {{ now()->year }} Coordify. Todos los derechos reservados.
    </div>

  </div>
</body>
</html>
