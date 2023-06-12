require('./bootstrap');

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
import IndexComponent from './components/todo/Index.vue';
import CreateComponent from './components/todo/Create.vue';
import EditComponent from './components/todo/Edit.vue';

const app = createApp(App)
app.use(VueAxios, axios)

const routes = [
    {
        name: 'todos',
        path: '/',
        component: IndexComponent
    },
    {
        name: 'create',
        path: '/create',
        component: CreateComponent
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditComponent
    }
];

const router = createRouter({
  mode: 'history',
  history: createWebHistory(),
  routes: routes
})

app.use(router)
app.mount('#app')