import 'flowbite';

// import { createApp, h } from 'vue';
// import * as VueRouter from 'vue-router';
// import NavBarComponent from './components/NavBarComponent.vue';

// import Login from './pages/auth/Login.vue';
// import Register from './pages/auth/Register.vue';


// import App from './layouts/App.vue';

// const app = createApp({
//     // render: () => h(App)
// });

// const routes = [
//     { path: '/login', component: Login, name: 'login' },
//     { path: '/register', component: Register, name: 'register' }
// ];

// const router = VueRouter.createRouter({
//     history: VueRouter.createWebHistory(),
//     routes
// });

// app.use(router);

// app.mount('#app');


import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
        console.log(name);
        return pages[`./pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})



// import { createApp } from 'vue';

// const app = createApp({});

// import NavBarComponent from './components/NavBarComponent.vue';
// import MainComponent from './components/MainComponent.vue';
// import BookAuthorComponent from './components/BookAuthorComponent.vue';

// app.component('nav-bar-component', NavBarComponent);
// app.component('book-author-component', BookAuthorComponent);
// app.component('main-component', MainComponent);

// app.mount('#app');
