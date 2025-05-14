@extends('_partials.layout')
@section('titlePage', 'Escáner QR')

@section('content')
    <div class="QRContainerReader p-5 flex gap-3 flex-col h-full justify-center">
        <div id="reader" class="w-[400px] lg:w-[500px]"></div>
    </div>
@endsection