import {createWebHistory, createRouter} from "vue-router";

const routes = [
    {
        path: "/products",
        name: "products",
        component: () => import("./components/Products")
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;