<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    userLogin: Object
});


console.log(props.userLogin.roles[0].name === 'patient');
const isPatient = props.userLogin.roles[0].name === 'patient';

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <div v-if="!isPatient">
                        <a class="w-full md:w-1/4 float-end text-center text-lg font-medium bg-indigo-800 hover:bg-indigo-950 rounded-lg text-white py-1 px-4"
                            href="/history/create">
                            Crear Historia Clínica
                        </a>
                    </div>

                    <div v-if="isPatient">
                        <a class="w-full md:w-1/4 float-end text-center text-lg font-medium bg-indigo-800 hover:bg-indigo-950 rounded-lg text-white py-1 px-4"
                            href="/history/">
                            Ver historias clinicas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
