import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from "./views/Index";
import Task from "./views/Task";

const routes = [
    {
        path: "/",
        component: Index
    },
    {
        path: "/task",
        component: Task
    },
];

export default new vueRouter({
    mode: "history",
    routes
});
