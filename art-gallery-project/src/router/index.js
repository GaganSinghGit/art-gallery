import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/Home.vue";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import ArtistHome from "../components/Artist/ArtistHome.vue";
import ExhibitionsIndex from "../components/Admin/Exhibitions/ExhibitionsIndex.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/artist",
        name: "ArtistHome",
        component: ArtistHome,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/exhibitions",
        name: "Exhibitions",
        component: ExhibitionsIndex,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
