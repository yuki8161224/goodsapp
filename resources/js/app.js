import { createApp } from 'vue';
import GoodsList from './components/GoodsList.vue';

const app = createApp({});
app.component('goods-list', GoodsList);
app.mount('#app');
