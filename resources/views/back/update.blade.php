@extends('_partials.layout')
@section('titlePage', 'Editar evento')

@section('content')

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <strong>Por favor corrige los siguientes errores:</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="md:w-5/6 sm:w-5/6 lg:w-4/6 bg-white h-auto lg:max-h-[90%] rounded-lg shadow-md p-6" action="{{ route('events.update', $event['id']) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" id="selectedCommunity" value="{{ old('community', $event->community) }}">
    <input type="hidden" id="selectedCategory" value="{{ old('categories', $event->category->name) }}">


    <div class="mb-6">
        <label class="block text-gray-700 mb-2" for="name">Nombre<span class="text-red-500">*</span></label>
        <input type="text" id="nameEvent" name="name" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('name', $event['name']) }}">
        @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block text-gray-700 mb-2" for="inputCategories">
                Categorías <span class="text-red-500">*</span>
            </label>
            <select id="inputCategories" name="categories" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="2"></select>
            @error('categories') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-2" for="community">
                Comunidad autónoma <span class="text-red-500">*</span>
            </label>
            <select id="communityList" name="community" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="2"></select>
            @error('community')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 mb-2" for="autocomplete">
            Dirección <span class="text-red-500">*</span>
        </label>
        <input id="autocomplete" name="address" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Introduce una dirección" value="{{ old('address', $event['address']) }}">
        @error('address') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        {{-- Fecha y hora de inicio --}}
        <div class="flex gap-3">
            <div class="w-[50%] 2xl:w-[60%]">
                <label class="block text-gray-700 mb-2" for="startDate">Fecha de inicio <span class="text-red-500">*</span></label>
                <input type="date" id="startDate" name="startDate" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('startDate', $event['startDate']) }}">
                @error('startDate') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="w-[50%] 2xl:w-[40%]">
                <label class="block text-gray-700 mb-2" for="startTime">Hora de inicio <span class="text-red-500">*</span></label>
                <input type="time" id="startTime" name="startTime" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('startTime', $event['startTime']) }}">
                @error('startTime') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Fecha y hora de fin --}}
        <div class="flex gap-3">
            <div class="w-[50%] 2xl:w-[60%]">
                <label class="block text-gray-700 mb-2" for="endDate">Fecha de finalización <span class="text-red-500">*</span></label>
                <input type="date" id="endDate" name="endDate" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('endDate', $event['endDate']) }}">
                @error('endDate') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="w-[50%] 2xl:w-[40%]">
                <label class="block text-gray-700 mb-2" for="endTime">Hora de finalización <span class="text-red-500">*</span></label>
                <input type="time" id="endTime" name="endTime" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('endTime', $event['endTime']) }}">
                @error('endTime') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="flex gap-4 items-start">
            <div class="w-[40%]">
                <label class="block text-gray-700 mb-2">Tipo de Evento <span class="text-red-500">*</span></label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="paymentType" value="free" id="freeRadio" @checked(old('paymentType', $event['paymentType']) == 'free') class="rounded-full border-gray-300 text-blue-600 focus:ring-blue-500"> Gratuito
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="paymentType" value="paid" id="paidRadio" @checked(old('paymentType', $event['paymentType']) == 'paid') class="rounded-full border-gray-300 text-blue-600 focus:ring-blue-500"> Pago
                </label>
                @error('paymentType') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="w-[60%] inputPrice {{ old('paymentType', $event['paymentType']) === 'paid' ? '' : 'hidden' }}">
                <label class="block text-gray-700 mb-2" for="price">Precio <span class="text-red-500">*</span></label>
                <input type="number" id="price" name="price" value="{{ old('price', $event['price']) }}" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('price') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>

        <div>
            <label class="block text-gray-700 mb-2" for="image">Imagen</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:rounded-md file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('image') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 mb-2" for="description">Descripción</label>
        <textarea id="description" name="description" rows="4" class="p-2 mt-1 block w-full h-18 max-h-40 min-h-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $event['description']) }}</textarea>
        @error('description') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div class="flex gap-4">
        <a href="{{ route('events.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md">Cancelar</a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Actualizar</button>
    </div>
</form>
@endsection

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-xoyvaSB2vcD1qoxCyRXsJ-FjDiCJS2g&libraries=places&v=weekly" defer></script>
<script>
    function initAutocomplete() {
        const input = document.getElementById('autocomplete');
        if (input) {
            const autocomplete = new google.maps.places.Autocomplete(input, {
                fields: ['place_id', 'name', 'formatted_address', 'geometry'],
                types: ['address'],
                componentRestrictions: { country: 'es' }
            });

            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();
                console.log(place.formatted_address);
            });
        }
    }

    window.addEventListener('load', initAutocomplete);
</script>
