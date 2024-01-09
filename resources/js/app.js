import './bootstrap';
import { createApp } from 'vue'

import App from './App.vue'
import parentComponent from './components/parentComponent.vue'
import addArticle from './components/addArticle.vue'
import editArticle from './components/editArticle.vue'

createApp(App).mount("#app")
createApp(parentComponent).mount("#parentComponent")
createApp(addArticle).mount("#addArticle")
createApp(editArticle).mount("#editArticle")



