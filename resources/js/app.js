import './bootstrap';
import { createApp } from 'vue'

import App from './App.vue'
createApp(App).mount("#app")
import parentComponent from './components/parentComponent.vue'
import addArticle from './components/addArticle.vue'
import editArticle from './components/editArticle.vue'
import select2 from './components/select2Tag.vue'



createApp(parentComponent).mount("#parentComponent")
createApp(addArticle).mount("#addArticle")
createApp(editArticle).mount("#editArticle")
createApp(select2).mount("#select2")


createApp(parentComponent).provide('globalVariable', 'some value').mount("#parentComponent")

