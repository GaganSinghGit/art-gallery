<template>
    <div class="max-w-xl mx-auto">
        <h4>Exhibitions List</h4>
        <div>
            <li v-for="exhibition in exhibitions">{{ exhibition.name }}</li>
        </div>
        <CreateExhibition class="my-6" @exhibition-created="getExhibitions" />
        <ManageArtifacts :artifacts="artifacts" :exhibitions="exhibitions" />
    </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";
import CreateExhibition from "./CreateExhibition.vue";
import ManageArtifacts from "./ManageArtifacts.vue";
export default {
    components: { CreateExhibition, ManageArtifacts },
    setup() {
        const exhibitions = ref([]);
        const getExhibitions = async function () {
            const { data: res } = await axios.get("/api/get-exhibitions");
            exhibitions.value = res;
            console.log(res);
        };
        const artifacts = ref([]);
        const getArtifacts = async function () {
            const { data: res } = await axios.get("/api/artifact");
            artifacts.value = res;
            console.log(res);
        };
        onMounted(() => {
            getExhibitions();
            getArtifacts();
        });
        return {
            exhibitions,
            artifacts,
            getExhibitions,
        };
    },
};
</script>

<style lang="scss" scoped></style>
