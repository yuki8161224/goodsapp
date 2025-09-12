<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Goods_create') }}
        </h2>
    </x-slot>
    <div class="create_wrpper">
        <div class="create-content">
            <h3>グッズを追加する</h3>
            <form method="POST" action="{{ route('goods.store') }}" enctype="multipart/form-data" class="create_btn">
                @csrf
                <div class="goods_name_create">
                    <label for="goods_name" class="name_label">グッズの名称</label>
                    <input type="text" name="goods_name" id="goods_name" required>
                </div>

                <div class="goods_price_create">
                    <label for="goods_price" class="price_label">グッズの価格</label>
                    <input type="number" name="price" id="goods_price" step="1" min="0" required>
                </div>

                <div class="goods_image_create">
                    <label for="goods_image" class="image_label">グッズの画像</label>
                    <input type="file" name="image_path" id="goods_image" accept="image/*" max="10240" enctype="multipart/form-data">
                </div>

                <button type="submit">追加する</button>
            </form>

        </div>
    </div>
</x-app-layout>