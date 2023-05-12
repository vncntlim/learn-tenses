<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="verb">Verb</label>
                                <input
                                    type="text"
                                    v-model="form.verb"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>

                            <!-- submit -->
                            <div class="flex items-center mt-4">
                                <button
                                    class="
                                        px-6
                                        py-2
                                        text-white
                                        bg-gray-900
                                        rounded
                                    "
                                >
                                    Search
                                </button>
                            </div>
                        </form>

                        <template v-if="showData">
                            <div class="row">
                                <div class="col-md-3 card mx-2 my-2" v-for="(data, index) in myData.data" :key="index">
                                    <div class="card-header">{{ data.title }}</div>
                                    <div class="card-body">
                                        <ul>
                                            <li v-for="(word, idxword) in data.words" :key="idxword">
                                                {{ word }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeLabel from "@/Components/Label";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import Reverso from 'reverso-api';
import { ref, reactive, computed } from 'vue'
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    setup() {
        
        const form = useForm({
            verb: null,
        });

        const showData = ref(false);
        
        const toggleData = () => {
            showData.value = !showData.value;
        };

        const myData = ref(null);

        const fetchData = async () => {
            try {
                const response = await axios({
                    method: 'post',
                    url: route("process-verb"),
                    data: {
                        verb: form.verb
                    }
                });
                myData.value = response;
                toggleData();
            } catch (error) {
                console.error(error);
            }
        };

        return { form, myData, fetchData, showData, toggleData };
    },
    methods: {
        submit() {
            this.fetchData();
        },
    },
};
</script>
