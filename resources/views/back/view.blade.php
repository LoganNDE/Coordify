@extends('_partials.layout')
@section('titlePage', 'Inicio')

@section('content')
    @if(session('success'))
        <script>
            console.log("{{ session('success') }}");
            const mylocalStorage = window.localStorage;
            mylocalStorage.setItem('successLaravel', "{{ session('success') }}");
        </script>
    @endif
        <div class="flex gap-3 flex-col w-[85%] lg:w-4/6 mt-8">
            <section class="w-full flex flex-col gap-3 bg-gray-100 min-h-[620px] rounded-lg p-10">
                <h1 class="text-2xl font-bold">Información del evento</h1>
                <div class="flex gap-10">
                    <div class="flex flex-col gap-3 mt-5">
                        <h2 class="text-xl">{{ $event['name'] }}</h2>
                        <p>{{ $event['description'] }}</p>
                    </div>
                    <div class="flex items-end">
                        <img class="rounded-lg" src="{{ Storage::url($event['image']) }}" alt="{{ $event['name'] }}">
                    </div>
                </div>


                <div class="mt-6 flex flex-col lg:max-h-[320px] overflow-auto pr-5">
                    
                @if (count($event->participants) === 0)
                    <h2 class="text-xl text-secundary font-bold mb-2">{{ count($event->participants) }} Participante</h2>
                @elseif (count($event->participants) < 2)
                    <h2 class="text-xl text-secundary font-bold mb-2">{{ count($event->participants) }} Participante</h2>
                @else
                    <h2 class="text-xl text-secundary font-bold mb-2">{{ count($event->participants) }} Participantes</h2>
                @endif
                    
                    @forelse ($event->participants as $participant)
                        <div class="info flex w-full justify-between items-center p-3 rounded-lg bg-gray-200 my-1">
                                    <span class="flex gap-2 items-center w-[25%]"><i class="fa-regular fa-circle-user"></i> {{ $participant['name'] }}</span>
                                    <span class="flex gap-2 items-center w-[25%]"><i class="fa-regular fa-envelope"></i> {{ $participant['email'] }}</span>
                                    <span class="flex gap-2 items-center justify-center w-[25%]"><i class="fa-solid fa-door-open"></i><span class="{{ $participant['status'] == 'pending' ? 'bg-red-700' : 'bg-green-700' }} h-[10px] w-[10px] rounded-full block"></span></span>
                                <div class="actionBtns flex gap-4 w-[25%]">
                                    <a href="{{ route('events.edit', $event['id']) }}"><img src="img/edit.svg" class="w-7" alt=""></a>
                                    <a href="{{ route('events.archive', $event['id']) }}"><img src="img/archive.svg" class="w-6" alt=""></a>
                                    <a href="{{ route('events.delete', $event['id']) }}"><img src="img/delete.svg" class="w-6 btnRemove" alt=""></a>
                                </div>
                            </div>
                    @empty
                        <p>Aún no hay participantes en tu evento. 😥</p>
                    @endforelse

                </div>

            </section>
        </div>
    @if(session('error'))
        <script>
            mylocalStorage = window.localStorage;
            mylocalStorage.setItem('laravelError', "{{ session('error') }}");
        </script>
    @endif
@endsection