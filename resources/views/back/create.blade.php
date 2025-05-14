@extends('_partials.layout')
@section('titlePage', 'Crear evento')

@section('content')
    <form class="md:w-5/6 sm:w-5/6 lg:w-4/6 bg-white rounded-lg shadow-md p-6" action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="user_id" value="{{ $id = isset(auth()->user()->user_id) ? auth()->user()->user_id : auth()->user()->id }}" hidden>
        
        <!-- Nombre -->
        <div class="mb-6">
            <label class="block text-gray-700 mb-2" for="name">Nombre<span class="text-red-500">*</span></label>
            <input type="text" id="nameEvent" name="name" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="1" value="{{ old('name') }}">
            @error('name')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>


        <!-- Categoria y Comunidad Autónoma -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 mb-2" for="inputCategories">
                    Categorias <span class="text-red-500">*</span>
                </label>
                <select id="inputCategories" name="categories" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="2"></select>
                @error('categories')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
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
    
        <!-- Provincia y Dirección -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div id="place-picker-box">
            </div>
            <div>
                <label class="block text-gray-700 mb-2" for="address">
                    Dirección <span class="text-red-500">*</span>
                </label>
                <input type="text" id="address" name="address" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="3">
                @error('address')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>
    
        <!-- Fechas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex gap-3">
                <div class="w-[50%] 2xl:w-[60%]">
                    <label class="block text-gray-700 mb-2" for="startDate">
                        Fecha de inicio <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="startDate" name="startDate" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="4">
                    @error('startDate')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-[50%] 2xl:w-[40%]">
                    <label for="startTime" class="block text-gray-700 mb-2">Hora de inicio <span class="text-red-500">*</span></label>
                    <input type="time" name="startTime" id="startTime" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="5">
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
                    <input type="date" id="endDate" name="endDate" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="6">
                    @error('endDate')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-[50%] 2xl:w-[40%]">
                    <label for="endTime" class="block text-gray-700 mb-2">Hora de finalización <span class="text-red-500">*</span></label>
                    <input type="time" name="endTime" id="endTime" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="7">
                    @error('endTime')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    
        <!-- Radio Buttons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex">
                <div class="w-[40%]">
                    <label class="block text-gray-700 mb-2">Tipo de Evento <span class="text-red-500">*</span></label>
                        <input type="radio" name="paymentType" value="free" id="freeRadio"
                            class="rounded-full border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            checked>
                        Gratuito

                    <label class="flex items-center gap-2">
                        <input type="radio" name="paymentType" value="paid" id="paidRadio" 
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
                    <input type="number" id="price" name="price" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="2">
                    @error('price')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                    @session('error')
                        <div class="text-red-500 text-sm">{{ session('error') }}</div>
                    @enderror
                </div>
            </div>

            <!-- Imagen -->
            <div>
                <label class="block text-gray-700 mb-2" for="image">
                    Imagen
                </label>
                <input type="file" id="image" name="image" 
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('image')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>
    
        <!-- Descripción -->
        <div class="mb-6">
            <label class="block text-gray-700 mb-2" for="description">
                Descripción
            </label>
            <textarea id="description" name="description" rows="4" 
                      class="p-2 mt-1 block w-full h-18 max-h-40 min-h-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" tabindex="10"></textarea>
            @error('description')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
    
        <!-- Botones finales -->
        <div class="flex gap-4">
            <a href="{{ route('events.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md" tabindex="11">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md" tabindex="12">
                Agregar
            </button>
        </div>
    </form>
@endsection

<script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyD-xoyvaSB2vcD1qoxCyRXsJ-FjDiCJS2g", v: "weekly"});</script>