@extends('_partials.layout-front')

@section('titlePage', 'Política de Privacidad')

@section('content')
<main class="w-[85%] lg:w-[80%] mx-auto py-12">
  <header class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Política de Privacidad</h1>
    <p class="text-gray-700 mt-2">Esta política describe cómo se recogen, usan y protegen tus datos en <strong>Coordify</strong>, titularidad de Logan Naranjo Rodríguez.</p>
  </header>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">1. Información básica</h2>
    <table class="table-auto w-full border border-gray-300">
      <tbody class="text-gray-700">
        <tr class="border-b border-gray-300">
          <td class="p-2 font-medium">Responsable:</td>
          <td class="p-2">Logan Naranjo Rodríguez</td>
        </tr>
        <tr class="border-b border-gray-300">
          <td class="p-2 font-medium">Finalidad:</td>
          <td class="p-2">Atender solicitudes, gestionar eventos, enviar comunicaciones comerciales y mejorar la experiencia del usuario.</td>
        </tr>
        <tr class="border-b border-gray-300">
          <td class="p-2 font-medium">Legitimación:</td>
          <td class="p-2">Consentimiento del interesado, ejecución de un contrato y cumplimiento de obligaciones legales.</td>
        </tr>
        <tr class="border-b border-gray-300">
          <td class="p-2 font-medium">Destinatarios:</td>
          <td class="p-2">No se ceden datos a terceros, salvo obligación legal o prestadores de servicios vinculados contractualmente.</td>
        </tr>
        <tr class="border-b border-gray-300">
          <td class="p-2 font-medium">Derechos:</td>
          <td class="p-2">Acceder, rectificar y suprimir los datos, así como otros derechos que puede consultar más abajo.</td>
        </tr>
        <tr>
          <td class="p-2 font-medium">Procedencia:</td>
          <td class="p-2">El propio interesado.</td>
        </tr>
      </tbody>
    </table>
  </section>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">2. ¿Quién es el responsable del tratamiento de tus datos?</h2>
    <p class="text-gray-700">Logan Naranjo Rodríguez<br>NIF: B12345678<br>Valencia, España<br>Email: <a href="mailto:info@coordify.logannr.me" class="text-blue-600 underline">info@coordify.logannr.me</a></p>
  </section>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">3. ¿Con qué finalidad tratamos tus datos personales?</h2>
    <p class="text-gray-700">Utilizamos los datos para prestar servicios, enviar comunicaciones sobre eventos, elaborar perfiles de preferencias de uso y gestionar funcionalidades de la plataforma.</p>
  </section>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">4. ¿Por cuánto tiempo conservaremos tus datos?</h2>
    <p class="text-gray-700">Los datos se conservarán mientras sean necesarios para la finalidad por la que fueron recogidos o mientras exista una obligación legal de conservarlos.</p>
  </section>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">5. ¿Cuál es la legitimación para el tratamiento de tus datos?</h2>
    <p class="text-gray-700">Consentimiento del usuario, relación contractual y cumplimiento de obligaciones legales.</p>
  </section>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">6. ¿A qué destinatarios se comunicarán tus datos?</h2>
    <p class="text-gray-700">No se cederán datos a terceros, salvo a prestadores de servicios necesarios para la prestación del servicio y cuando exista obligación legal.</p>
  </section>

  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">7. Transferencias internacionales</h2>
    <p class="text-gray-700">Algunos servicios pueden estar alojados fuera del EEE. En esos casos, Coordify garantiza que se cumplirá con la legislación aplicable mediante Cláusulas Contractuales Tipo u otros mecanismos adecuados.</p>
  </section>

  <section>
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">8. Derechos del usuario</h2>
    <p class="text-gray-700">Tienes derecho a acceder, rectificar, suprimir, limitar u oponerte al tratamiento de tus datos, así como a la portabilidad de los mismos. Puedes ejercer estos derechos enviando un email a <a href="mailto:info@coordify.logannr.me" class="text-blue-600 underline">info@coordify.logannr.me</a>.</p>
    <p class="text-gray-700 mt-2">Si consideras que se han vulnerado tus derechos, puedes presentar una reclamación ante la <a href="https://www.aepd.es" target="_blank" class="text-blue-600 underline">Agencia Española de Protección de Datos</a>.</p>
  </section>
</main>
@endsection
