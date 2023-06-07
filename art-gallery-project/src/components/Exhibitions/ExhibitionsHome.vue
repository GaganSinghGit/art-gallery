<template>
    <div>
        <h2>List of Exhibitions with Artifacts</h2>
        <div class="mt-6" v-for="exhibition in exhibitions">
            <h3>
                <b>{{ exhibition.name }}</b> from {{ exhibition.start_time }} to
                {{ exhibition.end_time }}
            </h3>
            <h4>Artifacts fot this exhibition are</h4>
            <div v-for="artifact in exhibition.artifacts">
                <h5>{{ artifact.name }}</h5>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from "vue";
import axios from "axios";
export default {
    setup() {
        const exhibitions = ref([]);
        const getExhibitionsWithArtifacts = async () => {
            const { data: res } = await axios.get(
                "/api/get-exhibitions-with-artifacts"
            );
            exhibitions.value = res;
        };

        onMounted(() => {
            getExhibitionsWithArtifacts();
        });
        return {
            exhibitions,
        };
    },
};
</script>

<style lang="scss" scoped></style>
