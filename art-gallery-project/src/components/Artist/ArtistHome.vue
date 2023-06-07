<script>
import { onMounted } from "vue";
import { useAuthStore } from "../../stores/auth";
import CreateArtifactForm from "../Artifacts/CreateArtifactForm.vue";
export default {
    components: {
        CreateArtifactForm,
    },
    setup() {
        const authStore = useAuthStore();

        onMounted(async () => {
            authStore.getUser();
        });

        return {
            authStore,
        };
    },
};
</script>
<template>
    <div class="max-w-xl mx-auto">
        <h3>Artist Home Page</h3>
        <div v-if="authStore.user">
            <h1>{{ authStore.user.name }}</h1>
            <p>{{ authStore.user.email }}</p>
        </div>
        <div v-else>
            <h1>Go and login</h1>
        </div>
        <CreateArtifactForm></CreateArtifactForm>
    </div>
</template>

<style lang="scss" scoped></style>
