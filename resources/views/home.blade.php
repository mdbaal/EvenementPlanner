<x-app-layout>
    <div class="shadow-xl mb-10">
        <div class="bg-gray-500 w-full h-60 text-white text-center text-3xl">Grote afbeelding</div>
    </div>

    <h1 class="text-3xl mb-3" >De leukste evenementen voor jou!</h1>
    <div class="flex flex-row gap-2">
        <div class="bg-gray-500 w-full h-60 text-white rounded shadow-lg cursor-pointer text-center">Evenement (Klik hier)</div>
        <div class="bg-gray-400 w-full h-60 text-white rounded shadow-lg cursor-pointer text-center">Evenement (Klik hier)</div>
        <div class="bg-gray-600 w-full h-60 text-white rounded shadow-lg cursor-pointer text-center">Evenement (Klik hier)</div>
    </div>

    <h2 class="text-2xl mt-10 mb-1">Alle evenementen</h2>
    <div class="rounded flex flex-col gap-5">
        @php $events = \App\Models\Event::all() @endphp
        @foreach( $events as $event)
            <div class="p-2 bg-gray-500 w-full min-h-20 text-white rounded shadow-lg cursor-pointer text-center transition delay-100 ease-in-out hover:translate-y-1 hover:scale-110">
                <strong>{{ $event->title }}</strong>
                <p>{{ $event->excerpt }}</p>
                <div class="flex flex-row justify-center gap-5">
                    <span>Start datum: {{ $event->event_start }}</span>
                    @if( isset($event->event_end)) <span>Eind datum: {{ $event->event_end }}</span>@endif
                    <span>Locatie: {{ $event->location }}</span>
                    <span>&euro; {{ $event->entry_fee == 0 ? "Gratis" : $event->entry_fee  }}</span>
                </div>
            <livewire:attend-button eventId="{{ $event->id }}" />
            </div>
        @endforeach
    </div>
</x-app-layout>
