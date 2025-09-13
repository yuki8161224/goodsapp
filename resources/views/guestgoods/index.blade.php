<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Goods') }}
        </h2>
    </x-slot>

    <div class="goods_bg">
        <ul class="goods_wrapper">
            @foreach($goods as $item)
            <li class="goods_contents">
                <h3>{{ $item->goods_name }}</h3>
                <figure>
                    <img src="{{ asset('storage/' .$item->image_path) }}" alt="{{ $item->goods_name }}">
                    <figcaption>{{ $item->price }}円</figcaption>
                </figure>
            </li>
            @endforeach
        </ul>

    </div>
</x-app-layout>