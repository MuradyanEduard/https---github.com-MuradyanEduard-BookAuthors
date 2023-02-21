import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import BookNavBarComponent from './components/BookNavBarComponent.vue';
import BookComponent from './components/BookComponent.vue';
import BookMainComponent from './components/BookMainComponent.vue';

app.component('book-nav-bar-component', BookNavBarComponent);
app.component('book-component', BookComponent);
app.component('book-main-component', BookMainComponent);

app.mount('#app');
