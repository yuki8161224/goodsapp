<template>
  <div class="goods_bg">
    <div v-if="showModal" class="total_modal">
      <button @click="showModal = false">閉じる</button>
      <h3>注文票</h3>
      <ul>
        <li v-for="item in cartItems" :key="item.goods_id">
          {{ item.goods_name }} - {{ item.quantity }}個 - {{ item.totalPrice }}円
        </li>
      </ul>
      <p>合計金額: {{ totalAmount }}円</p>
    </div>
    <ul class="goods_wrapper">
      <li v-for="item in goods" :key="item.goods_id" class="goods_contents">
        <h3>{{ item.goods_name }}</h3>
        <figure>
          <img :src="item.image_path" :alt="item.goods_name" />
          <figcaption>{{ item.price }}円</figcaption>
        </figure>
        <div class="btn-wrapper">
          <div class="num-wrapper">
            <button type="button" @click="decrementQuantity(item)" class="rembtn"></button>
            <input type="number" :value="item.quantity" @input="updateQuantity(item, $event)" min="0" class="w-20 text-center border rounded-md" />
            <button type="button" @click="incrementQuantity(item)" class="addbtn"></button>
          </div>
          <button type="button" @click="addToCart(item)">
            カートに追加する
          </button>
        </div>
      </li>
    </ul>
    <button id="total-submit" @click="showModal = true">注文票を表示する</button>
  </div>
</template>

<script>
import { computed, onMounted, ref } from 'vue';
import axios from 'axios';

export default {
  setup() {
    const goods = ref([]);
    const showModal = ref(false);

    const cartItems = computed(() => {
      return goods.value.filter(item => item.quantity > 0).map(item => ({
        ...item,
        totalPrice: item.price * item.quantity,
      }));
    });

    const totalAmount = computed(() => {
      return cartItems.value.reduce((sum, item) => sum + item.totalPrice, 0);
    });

    const incrementQuantity = (item) => {
      item.quantity++;
    };

    const decrementQuantity = (item) => {
      if (item.quantity > 0) {
        item.quantity--;
      }
    };

    const updateQuantity = (item, event) => {
      let value = parseInt(event.target.value);
      if (isNaN(value) || value < 0) {
        value = 0;
      }
      item.quantity = value;
    };

    const fetchGoods = async () => {
      try {
        const response = await axios.get('/api/goods'); // APIルートを作成
        goods.value = response.data.map(item => ({ ...item, quantity: 0 }));
      } catch (error) {
        console.error("Error fetching goods:", error);
      }
    };

    onMounted(() => {
      fetchGoods();
    });

    return {
      goods,
      showModal,
      cartItems,
      totalAmount,
      incrementQuantity,
      decrementQuantity,
      updateQuantity,
    };
  }
};
</script>

<style scoped>
/* スタイルは元のstyle.cssを使用 */
</style>