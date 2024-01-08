import './bootstrap';
import { createApp } from 'vue'

import App from './App.vue'
import addArticle from './components/addArticle.vue'
import editArticle from './components/editArticle.vue'

createApp(App).mount("#app")
createApp(addArticle).mount("#addArticle")
createApp(editArticle).mount("#editArticle")

