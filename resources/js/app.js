import './bootstrap';
import 'laravel-datatables-vite';
import "datatables.net-editor";
import Editor from "datatables.net-editor-bs5";
Editor(window, $);
import { createApp } from "vue";
import App from "./App.vue";

createApp(App).mount("#app");
