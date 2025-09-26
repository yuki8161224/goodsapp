<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Goods') }}
        </h2>
    </x-slot>

    <div id="app">
        <goods-list></goods-list>
    </div>
</x-app-layout>