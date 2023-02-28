// import './bootstrap';
import 'flowbite';

import { createApp } from 'vue';

const app = createApp({});

import NavBarComponent from './components/NavBarComponent.vue';
import MainComponent from './components/MainComponent.vue';
import BookAuthorComponent from './components/BookAuthorComponent.vue';

app.component('nav-bar-component', NavBarComponent);
app.component('book-author-component', BookAuthorComponent);
app.component('main-component', MainComponent);

app.mount('#app');
