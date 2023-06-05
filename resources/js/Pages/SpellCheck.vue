<template>
    <Head title="Spell Check" />

    <BreezeGuestLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Spell Check
            </h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="sentence">Sentence</label>
                                <textarea
                                    v-model="form.sentence"
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
                                ></textarea>
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
                                    Check
                                </button>
                            </div>
                        </form>

                        <template v-if="showData">
                            <div class="alert alert-warning my-4" role="alert" v-if="myData.corrections.length > 0">
                                <h4 class="alert-heading">Well Done!</h4>
                                <p>I have some suggestions to improve your sentence:</p>
                                <h5 class="font-weight-bold">{{ myData.text }}</h5>
                                <hr>
                                <p>Here's some explaination(s):</p>
                                <ul>
                                    <li v-for="(correction, index) in myData.corrections" :key="index">
                                        {{ correction.corrected }}, {{ correction.explanation }}
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-success my-4" role="alert" v-else>
                                <h4 class="alert-heading">Well Done!</h4>
                                <hr>
                                <p>You made that look easy!</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>

<script>
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeLabel from "@/Components/Label";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import Reverso from 'reverso-api';
import { ref, reactive, computed } from 'vue'

const reverso = new Reverso();

export default {
    props: {
        word: String,
    },
    components: {
        BreezeGuestLayout,
        Head,
    },
    setup() {
        
        const form = useForm({
            sentence: null,
        });

        const showData = ref(false);
        
        const toggleData = () => {
            showData.value = !showData.value;
        };

        const myData = ref(null);

        const fetchData = async () => {
            try {
                reverso.getSpellCheck(form.sentence, 'english', (err, response) => {
                    if (err) throw new Error(err.message)
                    myData.value = response;
                    if (showData.value == false)
                        toggleData();
                });
            } catch (error) {
                console.error(error);
            }
        };

        return { form, myData, fetchData, showData, toggleData };
    },
    methods: {
        submit() {
            this.fetchData();
        }
    },
    mounted() {
        this.form.sentence = this.word;
    }
};
</script>
