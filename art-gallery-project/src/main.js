import { createApp, markRaw } from "vue";
import { createPinia } from "pinia";
import router from "./router";

import "./axios";
import "./style.css";
import App from "./App.vue";

import "@vuepic/vue-datepicker/dist/main.css";

const pinia = createPinia();

pinia.use(({ store }) => {
    store.router = markRaw(router);
});

const app = createApp(App);
app.use(pinia);
app.use(router);

app.mount("#app");
