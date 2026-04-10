<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm p-8">
                @php
                    $hour = now()->hour;
                    if ($hour < 12)      $greeting = 'Good Morning';
                    elseif ($hour < 17)  $greeting = 'Good Afternoon';
                    else                 $greeting = 'Good Evening';
                @endphp

                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $greeting }}, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-gray-500 mt-1">Welcome back to your English learning journey.</p>
            </div>
        </div>
    </div>
</x-app-layout>
