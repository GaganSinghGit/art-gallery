<script setup>
import { RouterView } from "vue-router";
import Nav from "./components/Nav.vue";
import UserInfo from "./components/UserInfo.vue";
</script>

<template>
    <main>
        <Nav />
        <UserInfo />
        <RouterView />
    </main>
</template>

<style scoped></style>
