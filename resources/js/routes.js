import Login from './pages/auth/Login.vue';
import Register from './pages/auth/Register.vue';

const routes = [
    {
        path: '/',
        component: Login,
    },
    {
        path: '/about',
        component: Register,
    },
];

export default routes;
