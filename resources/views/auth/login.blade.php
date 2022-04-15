<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <a href="{{route('auth.twitch.redirect')}}" class="rounded bg-gray-600 text-white flex py-1 px-4 ">
            <span style="vertical-align: middle">Login with</span>
            <svg width="100" class="mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1140 380"><defs><style>.cls-1{fill:#fff;}.cls-2{fill:#9146ff;}</style></defs><title>Asset 14</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><polygon class="cls-1" points="170 170.01 100 170.01 100 190 170 190 170 270.01 60 270.01 20 230.01 20 20 100 20 100 90 170 90 170 170.01"/><polygon class="cls-1" points="470 270.01 230 270.01 190 230.01 190 90 270 90 270 190 290 190 290 90 370 90 370 190 390 190 390 90 470 90 470 270.01"/><rect class="cls-1" x="490" y="90" width="80" height="180"/><rect class="cls-1" x="490" y="20" width="80" height="50"/><polygon class="cls-1" points="740 170.01 670 170.01 670 190 740 190 740 270.01 630 270.01 590 230.01 590 20 670 20 670 90 740 90 740 170.01"/><polygon class="cls-1" points="920 170.01 840 170.01 840 190 920 190 920 270.01 800 270.01 760 230.01 760 130.01 800 90 920 90 920 170.01"/><polygon class="cls-1" points="1120 270.01 1040 270.01 1040 170.01 1020 170.01 1020 270.01 940 270.01 940 20 1020 20 1020 90 1080 90 1120 130.01 1120 270.01"/><path class="cls-2" d="M1090,70h-50V0H930.21L879.72,70H790l-30,30V70H690V0H470V70H160.5L110,0H0V240L140,380H280V340l40,40H590V340l40,40H760V340l40,40h250l90-90V120ZM170,170H100v20h70v80H60L20,230V20h80V90h70ZM470,270H230l-40-40V90h80V190h20V90h80V190h20V90h80Zm100,0H490V90h80Zm0-200H490V20h80ZM740,170H670v20h70v80H630l-40-40V20h80V90h70Zm180,0H840v20h80v80H800l-40-40V130l40-40H920Zm200,100h-80V170h-20V270H940V20h80V90h60l40,40Z"/></g></g></svg>
        </a>
    </x-auth-card>
</x-guest-layout>
