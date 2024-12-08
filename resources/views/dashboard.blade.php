<x-navigation-layout title="Dashboard">

    <x-slot name="header">
        <div class="pt-4 ps-4">
            <h1 class="fs-5"><b>Dashboard</b></h1>

            <x-breadcrumb :items="[
                ['name' => 'Home', 'url' => route('dashboard')]
            ]" />
        </div>
    </x-slot>

    <div class="py-12">
        <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> -->
        <div class="center container">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
            <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <br> Hai {{ Auth::user()->name }}.
                    Welcome to Sistem Penilaian Siswa
                </div>
            </div>
        </div>
    </div>
</x-navigation-layout>