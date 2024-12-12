<x-navigation-layout title="Dashboard">

    <x-slot name="header">
        <h1 class="fs-5"><b>Dashboard</b></h1>
        <x-breadcrumb :items="[
            ['name' => 'Home', 'url' => route('dashboard')]
        ]" />
    </x-slot>

    <div class="py-4">
        <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> -->
        <div class="container">
            <div class="mx-4 bg-white overflow-hidden shadow-sm" style="border-radius: 10px">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                <div class="p-4">
                    {{ __("You're logged in!") }}
                    <br> Hai {{ Auth::user()->name }}.
                    Welcome to Sistem Penilaian Siswa
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>