
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'

import { createApp, markRaw  } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'


import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(ElementPlus)

const pinia = createPinia()

pinia.use(({ store }) => {
    store.router = markRaw(router)
})
pinia.use(piniaPluginPersistedstate)

app.use(pinia)

app.use(router)

app.mount('#app')
