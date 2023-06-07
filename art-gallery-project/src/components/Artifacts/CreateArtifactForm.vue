<template>
    <div>
        <h3>Create Artifact</h3>
        <form @submit.prevent="createArtifact">
            <div>
                <label for="name">Name</label>
                <input
                    type="text"
                    id="name"
                    v-model="artifactForm.name"
                    class="border-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none focus:border-primary focus-visible:shadow-none"
                />
            </div>
            <div>
                <label for="description">Description</label>
                <input
                    type="text"
                    id="description"
                    class="border-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none focus:border-primary focus-visible:shadow-none"
                    v-model="artifactForm.description"
                />
            </div>
            <div>
                <label for="price">Price</label>
                <input
                    type="text"
                    id="price"
                    v-model="artifactForm.price"
                    class="border-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none focus:border-primary focus-visible:shadow-none"
                />
            </div>
            <button
                type="submit"
                class="w-full px-4 py-3 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white mt-4"
            >
                Create
            </button>
        </form>
    </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
export default {
    setup() {
        const artifactForm = ref({
            name: "",
            description: "",
            price: "",
        });
        const createArtifact = async () => {
            const { data: res } = await axios.post("/api/artifact", {
                ...artifactForm.value,
            });
        };
        return {
            artifactForm,
            createArtifact,
        };
    },
};
</script>

<style lang="scss" scoped></style>
