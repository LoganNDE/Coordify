@extends('_partials.layout')
@section('titlePage', 'Escáner QR')

@section('content')
    <div class="QRContainerReader p-5 flex gap-3 flex-col h-full lg:mt-8">
        <div id="reader" class="mx-auto rounded-xl shadow-lg border border-gray-300 bg-white p-6 space-y-6 w-[400px] lg:w-[500px]"></div>
    </div>
@endsection