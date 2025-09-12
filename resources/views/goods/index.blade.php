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

                <form action="{{ route('goods.destroy', $item->goods_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </li>
            @endforeach
        </ul>
        <a href="{{ route('goods.create') }}" class="goods_create_btn"></a>
    </div>
</x-app-layout>