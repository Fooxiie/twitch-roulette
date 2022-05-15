<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">
        <span class="text-xl text-white">Mais ! Tu es pas censé être ici !</span>
        <img src="https://media2.giphy.com/media/6uGhT1O4sxpi8/giphy.gif"  alt="Vincent vega"/>
        @if (isset($twitch_channel))
            <a class="text-white bg-gray-700 py-2 px-2 rounded my-1 hover:bg-red-600" href="https://twitch.tv/{{$twitch_channel}}">Rentrer !</a>
        @endif
    </div>
</x-guest-layout>
