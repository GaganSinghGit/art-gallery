<script setup>
import { onMounted } from "vue";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();

onMounted(async () => {
    await authStore.getUser();
});
</script>

<template>
    <div v-if="authStore.user">
        you are logged in as {{ authStore.user.name }}
    </div>
    <div v-else>not logged in</div>
</template>

<style lang="scss" scoped></style>
