<script setup>

import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted } from 'vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    userLogin: Object,
    histories: Array
});




//funcion que me retorne un salso o verdadero ispatient
const isPatient = props.userLogin.roles[0].name === 'patient';
console.log(props.histories);


const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const isLoading = ref(false);
const historias = ref(props.histories);
const searchQuery = ref('');
const selectedPatientId = ref(null);
const patients = ref([]);
const estadoPaciente = ref('');
const antecedentes = ref('');
const evolucion_final = ref('');
const concepto_profesional = ref('');
const recomendaciones = ref('');
const fecha_Hora = ref('');



const fetchPatients = async () => {
    if (searchQuery.value.length > 1) {

        try {
            const response = await axios.get(`http://localhost:8002/api/v1/pacientes?query=${searchQuery.value}`);
            patients.value = response.data;

        } catch (error) {
            console.error(error);
            // Aquí puedes manejar el error, por ejemplo, mostrando un mensaje al usuario
        }
    } else {
        patients.value = [];
    }
};

//funcion para retornr la hora y fecha actual
const fechaHora = () => {
    const fecha = new Date();
    const fechaFormateada = `${fecha.getFullYear()}-${fecha.getMonth() + 1}-${fecha.getDate()}T${fecha.getHours()}:${fecha.getMinutes()}`;
    return fechaFormateada;
};

const submitForm = async () => {
    if (!selectedPatientId.value) {
        alert("Por favor, selecciona el paciente al que deseas agregar la historia clínica.");
        return;
    }
    if (!estadoPaciente.value) {
        alert("Por favor, ingresa el estado del paciente.");
        return;
    }
    isLoading.value = true;

    try {
        const payload = {
            patient_id: selectedPatientId.value,
            estado_paciente: estadoPaciente.value,
            antecedentes: antecedentes.value,
            evolucion_final: evolucion_final.value,
            concepto_profesional: concepto_profesional.value,
            recomendaciones: recomendaciones.value,
            fecha_hora: fecha_Hora.value

        };

        const response =  await axios.post('/history/store', payload, {
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        // mostrar la respuesta

        if (response.data.status === 200) {
            isLoading.value = false;
            alert("Historia clínica guardada correctamente");

            // Limpiar los campos
            searchQuery.value = '';
            selectedPatientId.value = null;
            estadoPaciente.value = '';
            antecedentes.value = '';
            evolucion_final.value = '';
            concepto_profesional.value = '';
            recomendaciones.value = '';
            fecha_Hora.value = '';
            patients.value = [];

        }else if(response.data.status === 419){
            alert("Hubo un error al guardar la historia clínica");

        } else {
            alert("Hubo un error al guardar la historia clínica");

        }


        // Redirigir o actualizar la vista según sea necesario
    } catch (error) {
        console.error(error);
        // Manejar errores aquí
    }


};

const selectPatient = (patientId) => {
    selectedPatientId.value = patientId;
    fecha_Hora.value = fechaHora();
};



</script>

<template>

    <AppLayout title="Crear historia">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ isPatient ? 'Historia Clínica' : 'Crear Historia Clínica' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-4">

                                    <form v-if="!isPatient"  @submit.prevent="submitForm">
                                        <div class=" flex items-center justify-between gap-4">
                                            <input class="w-1/2 form-control" type="text"
                                            v-model="searchQuery" @input="fetchPatients"
                                            placeholder="Ingresa número de documento del paciente">

                                            <ul v-if="patients && patients.length">
                                                <li class="cursor-pointer bg-indigo-800 text-white py-1 px-6 rounded shadow-lg hover:bg-indigo-950"  v-for="patient in patients" :key="patient.id"
                                                    @click="selectPatient(patient.id)">
                                                    {{ patient.name }} {{ patient.last_name }} CC. {{ patient.identification }}
                                                </li>
                                            </ul>
                                        </div>


                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-4">
                                            <div class="flex flex-col">
                                                <label class="text-sm" for="estadoPaciente">Estado del paciente</label>
                                                <input class="form-control" type="text" v-model="estadoPaciente" placeholder="Estado del paciente" />
                                            </div>
                                            <div class="flex flex-col">
                                                <label class="text-sm" for="antecedentes">Antecedentes</label>
                                                <textarea placeholder="Ingresa los antecedentes del paciente"
                                                class="form-control" v-model="antecedentes"></textarea>
                                            </div>
                                            <div class="flex flex-col">
                                                <label class="text-sm" for="evolucion_final">Evolucion final</label>
                                                <textarea placeholder="Ingresa la evolución del paciente"
                                                class="form-control"
                                                v-model="evolucion_final"></textarea>
                                            </div>
                                            <div class="flex flex-col">
                                                <label class="text-sm" for="concepto_profesional">Concepto profesional</label>
                                                <textarea placeholder="Ingrese su concepto como profesional" class="form-control"
                                                v-model="concepto_profesional"></textarea>
                                            </div>
                                            <div class="flex flex-col">
                                                <label class="text-sm" for="recomendaciones">Recomendaciones</label>
                                                <textarea class="form-control" v-model="recomendaciones"></textarea>
                                            </div>

                                        </div>

                                        <div>
                                            <button class="w-full md:w-1/4 float-end text-center text-lg font-medium bg-indigo-800 hover:bg-indigo-950 rounded-lg text-white py-1 px-4  mt-10 mb-8"
                                             type="submit" v-if="!isLoading">Guardar Historia Clínica</button>
                                            <span class="w-full md:w-1/4 float-end text-center text-lg font-medium bg-indigo-800 hover:bg-indigo-950 rounded-lg text-white py-1 px-4  mt-10 mb-8"
                                             v-else>Guardando...</span>
                                        </div>

                                    </form>
                                    <div v-if="isPatient">
                                        <ul>
                                            <li v-for="historia in historias" :key="historia.id">
                                                <div>ID: {{ historia.id }}</div>
                                                <div>Fecha y Hora: {{ historia.fecha_hora }}</div>
                                                <div>Consecutivo del Paciente: {{ historia.consecutivo_paciente }}</div>
                                                <div>Estado del Paciente: {{ historia.estado_paciente }}</div>
                                                <!-- Agrega más campos según sea necesario -->
                                            </li>
                                        </ul>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </AppLayout>
</template>
