import { createApp } from 'vue'
import App from './App.vue'
import AddGovernment from "./components/AddGovernment.vue";
import ButtonComponent from "./components/ButtonComponent.vue";
import LabelComponent from "./components/LabelComponent.vue";
import TextInputComponent from "./components/TextInputComponent.vue";
import Loading from "./components/Loading.vue";

const app = createApp(App)
app.component('add-government', AddGovernment);
app.component('label-component', LabelComponent);
app.component('button-component', ButtonComponent);
app.component('text-input-component', TextInputComponent);
app.component('loading', Loading);
app.mount('#app');

