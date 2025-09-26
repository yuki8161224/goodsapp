import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue'; // Vueをインポート

import GoodsList from './components/GoodsList.vue'; // 新しく作成するVueコンポーネント

window.Alpine = Alpine;

Alpine.start();

const app = createApp({});

app.component('goods-list', GoodsList);

app.mount('#app');