<x-guest-layout>
    <form action="{{route('form.test')}}" method="get">
        @csrf
        <label>
            Amount
            <input type="text" name="amount" />
        </label>
        <label>
            Pseudo
            <input type="text" name="pseudo" />
        </label>
        <label>
            Chiffre choisis
            <input type="text" name="chiffre" />
        </label>
        <input type="submit" />
    </form>

    <h3>Paris dans la game</h3>
    @php
        $game = App\Models\Game::query()->find(1)->first();
    @endphp
    <ul id="list bet">
        @foreach($game->bets as $bet)
            <li>From : {{$bet->viewer}} on {{$bet->number}} with {{$bet->amount}}</li>
        @endforeach
    </ul>
    <button onclick="spinMe()">Spin fucking roulette</button>
    <span id="coucou"></span>

    <button onclick="verifyBet()">Vérifier les paris</button>
    <div id="result">

    </div>

    <script>
        function spinMe() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("coucou").innerHTML =
                        this.responseText;
                }
            };
            xhttp.open("GET", '{{route('test.spin', ['game_id' => $game->id])}}', true);
            xhttp.send();
        }

        function verifyBet() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById('result').innerHTML = this.responseText;
                }
            }
            xhttp.open("GET", '{{route('test.verifbet', ['game_id' => $game->id])}}', true);
            xhttp.send();
        }
    </script>
</x-guest-layout>
