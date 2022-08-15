<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6
        svg_background sm:pt-0"
     style="background-image: url('{{asset('storage/carte_poker.svg')}}');">
    <div>
        {{ $logo }}
    </div>

    <div class="container mt-6 px-6 py-4 bg-casino shadow-md
    overflow-hidden sm:rounded-lg" style="background: linear-gradient(135deg,
        #972e33 80%, #971724 20%);">
        {{ $slot }}
    </div>
</div>
