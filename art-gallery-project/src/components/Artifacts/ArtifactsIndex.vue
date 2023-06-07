<template>
    <div>
        <h1>List of Artifacts</h1>
        <div class="flex">
            <div class="ml-2" v-for="artifact in artifacts">
                <span>{{ artifact.name }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from "vue";
import axios from "axios";
export default {
    name: "ArtifactsIndex",
    setup() {
        const artifacts = ref([]);
        const getArtifact = async () => {
            const { data: res } = await axios.get("/api/artifact");
            artifacts.value = res;
        };

        onMounted(async () => {
            getArtifact();
        });

        return {
            artifacts,
        };
    },
};
</script>

<style lang="scss" scoped></style>
