import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    // ★★★ ここから追加 ★★★
    server: {
        host: '0.0.0.0', // 外部からの接続を許可
        hmr: {
            host: 'localhost', // ブラウザが接続するホスト名
            port: 5174, // docker-compose.ymlでホストにマッピングされているポート (5174:5173 を想定)
        },
        port: 5173, // コンテナ内のViteのポート
    }
    // ★★★ ここまで追加 ★★★
});