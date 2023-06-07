<template>
    <div class="container mx-auto">
        <h4>Create Exhibition</h4>
        <div class="-mx-4 flex flex-wrap">
            <div class="w-full px-4">
                <div class="mb-6">
                    <label>Exhibition Name</label>
                    <input
                        type="text"
                        v-model="name"
                        class="border-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none focus:border-primary focus-visible:shadow-none"
                    />
                </div>
                <div class="mb-6">
                    <label>Start Date</label>

                    <VueDatePicker v-model="startDate"></VueDatePicker>
                </div>
                <div class="mb-6">
                    <label>End Date</label>
                    <VueDatePicker v-model="endDate"></VueDatePicker>
                </div>
                <div>
                    <button
                        @click="createExhibition"
                        class="w-full px-4 py-3 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueDatePicker from "@vuepic/vue-datepicker";
import axios from "axios";
import { ref } from "vue";
export default {
    components: { VueDatePicker },
    emits: ["exhibition-created"],
    setup(props, { emit }) {
        const startDate = ref(null);
        const endDate = ref(null);
        const name = ref("");

        const createExhibition = async function () {
            await axios.post("/api/create-exhibition", {
                name: name.value,
                startDate: startDate.value,
                endDate: endDate.value,
            });
            emit("exhibition-created");
        };

        return {
            startDate,
            endDate,
            name,
            createExhibition,
        };
    },
};
</script>

<style lang="scss" scoped></style>
