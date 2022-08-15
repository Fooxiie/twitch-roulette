<x-guest-layout>
    <x-auth-card class="">
        <x-slot name="logo">
            <a href="/">
                <x-application-logo
                    class="w-20 h-20 fill-current text-gray-500"/>
            </a>
        </x-slot>

        <h1 class="text-xl font-bold text-white">Envie de jouer le
            croupier devant tes viewers ?
        </h1><br/>

        <p class="italic text-white">Actuellement à Alpha, l'accès est
            restreint.
            Pour
            demander l'accès ou récupérer les infos nécessaire rendez-vous sur
            le discord et créer un ticket <a
                href="https://discord.gg/VCRKu6uFf5"
                class="text-blue-300 underline">Lien du discord</a></p>
        <br/>

        <div class="flex flex-row text-white px-6 hidden">
            <div class="w-full">
                <h2 class="text-lg">Pour le streamer</h2>
                <ul class="list-disc">
                    <li>Créer une salle didié</li>
                    <li>Gestion des jetons par Wizebot directement sur
                        son stream
                    </li>
                    <li>Proposer un nombre de place à sa communauté
                        pour venir jouer
                    </li>
                    <li>Permettre a ses viewers de profiter des gains
                        accumuler par la boutique Wizebot
                    </li>
                </ul>
            </div>
            <div class="px-4 border-white" style="border-left: 1px solid
            white;">
            </div>
            <div class="w-full px-6">
                <h2 class="text-lg">Pour les viewers</h2>
                <ul class="list-disc">
                    <li>Jouer avec son streamer</li>
                    <li>Gagner des bonus</li>
                </ul>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <br/>
        <h2 class="text-white">Ici la connexion se fait par twitch ! Clique ne
            sois pas
            timide !
        </h2>
        <a href="{{route('auth.twitch.redirect')}}"
           class="rounded bg-gray-800 text-white flex py-2 px-4 text-xl justify-center w-auto">
            <svg width="100" class="mx-2" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 1140 380">
                <defs>
                    <style>.cls-1 {
                            fill: #fff;
                        }

                        .cls-2 {
                            fill: #9146ff;
                        }</style>
                </defs>
                <title>Asset 14</title>
                <g id="Layer_2" data-name="Layer 2">
                    <g id="Layer_1-2" data-name="Layer 1">
                        <polygon class="cls-1"
                                 points="170 170.01 100 170.01 100 190 170 190 170 270.01 60 270.01 20 230.01 20 20 100 20 100 90 170 90 170 170.01"/>
                        <polygon class="cls-1"
                                 points="470 270.01 230 270.01 190 230.01 190 90 270 90 270 190 290 190 290 90 370 90 370 190 390 190 390 90 470 90 470 270.01"/>
                        <rect class="cls-1" x="490" y="90" width="80"
                              height="180"/>
                        <rect class="cls-1" x="490" y="20" width="80"
                              height="50"/>
                        <polygon class="cls-1"
                                 points="740 170.01 670 170.01 670 190 740 190 740 270.01 630 270.01 590 230.01 590 20 670 20 670 90 740 90 740 170.01"/>
                        <polygon class="cls-1"
                                 points="920 170.01 840 170.01 840 190 920 190 920 270.01 800 270.01 760 230.01 760 130.01 800 90 920 90 920 170.01"/>
                        <polygon class="cls-1"
                                 points="1120 270.01 1040 270.01 1040 170.01 1020 170.01 1020 270.01 940 270.01 940 20 1020 20 1020 90 1080 90 1120 130.01 1120 270.01"/>
                        <path class="cls-2"
                              d="M1090,70h-50V0H930.21L879.72,70H790l-30,30V70H690V0H470V70H160.5L110,0H0V240L140,380H280V340l40,40H590V340l40,40H760V340l40,40h250l90-90V120ZM170,170H100v20h70v80H60L20,230V20h80V90h70ZM470,270H230l-40-40V90h80V190h20V90h80V190h20V90h80Zm100,0H490V90h80Zm0-200H490V20h80ZM740,170H670v20h70v80H630l-40-40V20h80V90h70Zm180,0H840v20h80v80H800l-40-40V130l40-40H920Zm200,100h-80V170h-20V270H940V20h80V90h60l40,40Z"/>
                    </g>
                </g>
            </svg>
        </a>
    </x-auth-card>
</x-guest-layout>
