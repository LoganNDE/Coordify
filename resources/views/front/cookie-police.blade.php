@extends('_partials.layout-front')

@section('titlePage', 'Política de Cookies')

@section('content')
<main class="w-[85%] lg:w-[80%] mx-auto py-6">
  <header class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Política de Cookies</h1>
  </header>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">1. ¿Qué son las cookies?</h2>
    <p class="text-gray-700 text-justify">
      Las cookies son pequeños archivos de texto que se almacenan en el navegador del usuario cuando visita un sitio web. Su finalidad principal es reconocer al usuario en futuras visitas, mejorar la experiencia de navegación y permitir funcionalidades técnicas esenciales.
    </p>
  </section>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">2. Tipos de cookies utilizadas en Coordify</h2>
    <p class="text-gray-700 text-justify mb-4">
      En <a href="https://coordify.logannr.me" class="text-blue-600 underline">https://coordify.logannr.me</a> únicamente se utilizan cookies técnicas esenciales que permiten el correcto funcionamiento de la plataforma:
    </p>
    <ul class="list-disc list-inside text-gray-700 space-y-2">
      <li><strong>laravel_session:</strong> Cookie de sesión generada automáticamente por el framework Laravel. Se utiliza para mantener la sesión del usuario mientras navega por la plataforma.</li>
      <li><strong>XSRF-TOKEN:</strong> Cookie de seguridad generada por Laravel para prevenir ataques del tipo Cross-Site Request Forgery (CSRF). Protege los formularios del sitio web.</li>
    </ul>
    <p class="mt-4 text-gray-700 text-justify">
      Estas cookies son necesarias para la navegación y autenticación dentro de la plataforma, por lo que no pueden ser desactivadas desde nuestros sistemas.
    </p>
  </section>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">3. Gestión de cookies</h2>
    <p class="text-gray-700 text-justify">
      El usuario puede configurar su navegador para aceptar o rechazar por defecto todas las cookies, o para recibir una notificación en pantalla de la recepción de cada cookie y decidir en ese momento su implantación. No obstante, al tratarse de cookies técnicas, desactivarlas podría impedir el uso correcto del sitio web.
    </p>
  </section>

  <section>
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">4. Legislación y jurisdicción</h2>
    <p class="text-gray-700 text-justify">
      Esta Política de Cookies se rige por la legislación española y se complementa con el Aviso Legal y la Política de Privacidad de Coordify. Para cualquier cuestión legal relacionada con su uso, las partes se someten a los tribunales de Valencia.
    </p>
  </section>
</main>
@endsection
