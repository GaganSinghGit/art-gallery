<template>
    <h3>Add Artifacts to Exhibition</h3>
    <div class="flex flex-col">
        <label>Select Exhibition</label>
        <select
            v-model="selectedExhibitionId"
            class="border-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none focus:border-primary focus-visible:shadow-none"
        >
            <option v-for="exhibition in exhibitions" :value="exhibition.id">
                {{ exhibition.name }}
            </option>
        </select>
        <label>Select Artifact</label>
        <select
            v-model="selectedArtifactId"
            class="border-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none focus:border-primary focus-visible:shadow-none"
        >
            <option v-for="artifact in artifacts" :value="artifact.id">
                {{ artifact.name }}
            </option>
        </select>
        <button
            @click="addArtifactToExhibition"
            class="w-full px-4 py-3 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white mt-4"
        >
            Add
        </button>
    </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
export default {
    props: {
        artifacts: {
            type: Array,
            required: true,
        },
        exhibitions: {
            type: Array,
            required: true,
        },
    },
    setup() {
        const selectedExhibitionId = ref();
        const selectedArtifactId = ref();
        const addArtifactToExhibition = function () {
            axios.post(
                `/api/add-artifact-to-exhibition/${selectedExhibitionId.value}`,
                {
                    artifactId: selectedArtifactId.value,
                }
            );
        };
        return {
            addArtifactToExhibition,
            selectedExhibitionId,
            selectedArtifactId,
        };
    },
};
</script>

<style lang="scss" scoped></style>
