<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Goods') }}
        </h2>
    </x-slot>

    <div class="goods_bg">
        <ul class="goods_wrapper">
            @foreach($goods as $item)
            <li class="goods_contents" x-data="{ quantity: 0 }">
                <h3>{{ $item->goods_name }}</h3>
                <figure>
                    <img src="{{ asset('storage/' .$item->image_path) }}" alt="{{ $item->goods_name }}">
                    <figcaption>{{ $item->price }}円</figcaption>
                </figure>
                <div class="btn-wrapper">
                    <div class="num-wrapper">
                        <button type="button" @click="if (quantity > 0) quantity--" class="rembtn"></button>
                        <input
                            type="number"
                            id="quantity-{{ $item->goods_id }}"
                            min="0"
                            x-model.number="quantity"
                            class="w-20 text-center border rounded-md" />
                        <button type="button" @click="quantity++" class="addbtn"></button>
                    </div>
                    <button
                        type="button"
                        @click="quantity++">
                        カートに追加する
                    </button>
                </div>
            </li>
            @endforeach
        </ul>
        <a href="" class="total-submit">注文票を表示する</a>
    </div>
</x-app-layout>