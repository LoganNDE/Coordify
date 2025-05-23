@extends('_partials.layout')
@section('titlePage', 'Crear evento')

@section('content')
    <form class="md:w-5/6 sm:w-5/6 lg:w-4/6 bg-gray-100 h-auto lg:max-h-[90%] rounded-lg shadow-md p-6" action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label class="block text-gray-700 mb-2" for="name">Nombre<span class="text-red-500">*</span></label>
            <input type="text" id="nameEvent" name="name" class="p-2 mt-1 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Fuego y Calle: Espectáculo de Artistas Urbanos" tabindex="1" value="{{ old('name') }}">
            @error('name')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 mb-2" for="inputCategories">
                    Categorias <span class="text-red-500">*</span>
                </label>
                <select id="inputCategories" name="categories" style="background-color: white;" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="2"></select>
                @error('categories')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2" for="community">
                    Comunidad autónoma <span class="text-red-500">*</span>
                </label>
                <select id="communityList" name="community" style="background-color: white;" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="3"></select>
                @error('community')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>
    
        <div class="grid grid-cols-1 mb-6">
            <label class="block text-gray-700 mb-2" for="autocomplete">
                Dirección <span class="text-red-500">*</span>
            </label>
            <input id="autocomplete" name="address"
                class="p-2 mt-1 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Introduce una dirección" tabindex="4">
            @error('address')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex gap-3">
                <div class="w-[50%] 2xl:w-[60%]">
                    <label class="block text-gray-700 mb-2" for="startDate">
                        Fecha de inicio <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="startDate" name="startDate" class="p-2 mt-1 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="5">
                    @error('startDate')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-[50%] 2xl:w-[40%]">
                    <label for="startTime" class="block text-gray-700 mb-2">Hora de inicio <span class="text-red-500">*</span></label>
                    <input type="time" name="startTime" id="startTime" class="p-2 mt-1 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="6">
                    @error('startTime')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-[50%] 2xl:w-[60%]">
                    <label class="block text-gray-700 mb-2" for="endDate">
                        Fecha de finalización <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="endDate" name="endDate" class="p-2 mt-1 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="7">
                    @error('endDate')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-[50%] 2xl:w-[40%]">
                    <label for="endTime" class="block text-gray-700 mb-2">Hora de finalización <span class="text-red-500">*</span></label>
                    <input type="time" name="endTime" id="endTime" class="p-2 mt-1 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="8">
                    @error('endTime')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex">
                <div class="w-[40%]">
                    <label class="block text-gray-700 mb-2">Tipo de Evento <span class="text-red-500">*</span></label>
                        <input type="radio" name="paymentType" value="free" id="freeRadio" tabindex="9"
                            class="rounded-full border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            checked>
                        Gratuito

                    <label class="flex items-center gap-2">
                        <input type="radio" name="paymentType" value="paid" id="paidRadio" tabindex="10"
                            class="rounded-full border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        Pago
                    </label>
                    @error('paymentType')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-[60%] inputPrice hidden">
                    <label class="block text-gray-700 mb-2" for="price">
                        Precio <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="price" name="price" class="p-2 mt-1 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="11">
                    @error('price')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                    @session('error')
                        <div class="text-red-500 text-sm">{{ session('error') }}</div>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-2" for="image">
                    Imagen
                </label>
                <input type="file" id="image" name="image" tabindex="12"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('image')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>
    
        <div class="mb-6">
            <label class="block text-gray-700 mb-2" for="description">
                Descripción
            </label>
            <textarea id="description" name="description" rows="4" 
                        class="p-2 mt-1 block w-full h-18 max-h-40 min-h-10 rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="13"></textarea>
            @error('description')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="flex gap-4">
            <a href="{{ route('events.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md" tabindex="15">
                Cancelar
            </a>
            <button type="submit" class="bg-primary hover:primary cursor-pointer text-secundary px-4 py-2 rounded-md" tabindex="14">
                Agregar
            </button>
        </div>
    </form>
@endsection

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-xoyvaSB2vcD1qoxCyRXsJ-FjDiCJS2g&libraries=places&v=weekly" defer></script>
<script>
    function initAutocomplete() {
        const input = document.getElementById('autocomplete');
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

    window.addEventListener('load', initAutocomplete);
</script>