<script setup>
import { ref, reactive, onMounted } from 'vue'
import axios from 'axios'

// Base del API (ej: /ovelezmoro/championship_googlesheet/public/api)
const API_BASE = import.meta.env.VITE_API_BASE_URL || '/api'

const cargando = ref(false)
const errores = ref([])
const mensajeOk = ref('')

const campeonatos = ref([])

// Formulario de campeonato
const form = reactive({
    id_campeonato: null,
    nombre_campeonato: '',
    deporte: 'Vóley',
    ubicacion: '',
    detalle_ubicacion: '',
    fecha_inicio: '',
    fecha_fin: '',
    // Configuración de puntaje (mejor de 3)
    puntos_victoria_2_0: 3,
    puntos_victoria_2_1: 2,
    puntos_derrota_1_2: 1,
    puntos_derrota_0_2: 0,
})

const resetForm = () => {
    form.id_campeonato = null
    form.nombre_campeonato = ''
    form.deporte = 'Vóley'
    form.ubicacion = ''
    form.detalle_ubicacion = ''
    form.fecha_inicio = ''
    form.fecha_fin = ''
    form.puntos_victoria_2_0 = 3
    form.puntos_victoria_2_1 = 2
    form.puntos_derrota_1_2 = 1
    form.puntos_derrota_0_2 = 0
}

const cargarCampeonatos = async () => {
    cargando.value = true
    errores.value = []
    try {
        console.log("aa", API_BASE);
        const { data } = await axios.get(`${API_BASE}/campeonatos`)
        campeonatos.value = data
    } catch (e) {
        errores.value = ['No se pudo cargar la lista de campeonatos.']
    } finally {
        cargando.value = false
    }
}

const editarCampeonato = (c) => {
    mensajeOk.value = ''
    errores.value = []

    form.id_campeonato = c.id_campeonato
    form.nombre_campeonato = c.nombre_campeonato
    form.deporte = c.deporte
    form.fecha_inicio = c.fecha_inicio
    form.fecha_fin = c.fecha_fin

    // Estos campos sólo se llenan si existen en tu API/BD.
    form.ubicacion = c.ubicacion || ''
    form.detalle_ubicacion = c.detalle_ubicacion || ''

    // Si luego guardas la configuración de puntos en otra tabla,
    // aquí podrías traerla y setearla; de momento usamos valores por defecto.
}

const guardar = async () => {
    errores.value = []
    mensajeOk.value = ''

    // Validación simple en FE
    if (!form.nombre_campeonato || !form.fecha_inicio) {
        errores.value.push('Nombre del campeonato y fecha de inicio son obligatorios.')
        return
    }

    try {
        const payload = {
            nombre_campeonato: form.nombre_campeonato,
            descripcion: form.detalle_ubicacion, // por ahora usamos detalle de ubicación como descripción
            deporte: form.deporte,
            categoria_general: null,
            fecha_inicio: form.fecha_inicio,
            fecha_fin: form.fecha_fin || null,
            estado: 'CONFIGURACION',
            // Si agregas columnas `ubicacion` y `detalle_ubicacion` en la tabla,
            // aquí las envías también:
            ubicacion: form.ubicacion,
            detalle_ubicacion: form.detalle_ubicacion,
        }

        if (form.id_campeonato) {
            // Update
            await axios.put(`${API_BASE}/campeonatos/${form.id_campeonato}`, payload)
            mensajeOk.value = 'Campeonato actualizado correctamente.'
        } else {
            // Create
            await axios.post(`${API_BASE}/campeonatos`, payload)
            mensajeOk.value = 'Campeonato creado correctamente.'
        }

        await cargarCampeonatos()
        // resetForm()   // si quieres limpiar después de guardar
    } catch (e) {
        if (e.response?.data?.errors) {
            errores.value = Object.values(e.response.data.errors).flat()
        } else {
            errores.value = ['Ocurrió un error al guardar el campeonato.']
        }
    }
}

onMounted(() => {
    cargarCampeonatos()
})
</script>

<template>
    <div>
        <!-- Alertas -->
        <div v-if="errores.length" class="alert alert-danger">
            <ul class="mb-0">
                <li v-for="(err, i) in errores" :key="i">{{ err }}</li>
            </ul>
        </div>

        <div v-if="mensajeOk" class="alert alert-success">
            {{ mensajeOk }}
        </div>

        <!-- Card principal -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Mantenimiento de Campeonato</span>
                <div>
                    <button
                        type="button"
                        class="btn btn-sm btn-outline-secondary me-2"
                        @click="resetForm"
                    >
                        Volver / Nuevo
                    </button>
                    <button
                        type="button"
                        class="btn btn-sm btn-primary"
                        @click="guardar"
                    >
                        Guardar
                    </button>
                </div>
            </div>

            <div class="card-body">
                <!-- Primera fila: nombre, deporte, ubicación -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Nombre del campeonato</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="form.nombre_campeonato"
                            placeholder="Ej: Copa Verano U-10"
                        />
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Deporte</label>
                        <select v-model="form.deporte" class="form-select">
                            <option value="Vóley">Vóley</option>
                            <option value="Fútbol">Fútbol</option>
                            <option value="Básquet">Básquet</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Ubicación</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="form.ubicacion"
                            placeholder="Ej: Coliseo Eduardo Dibós"
                        />
                    </div>
                </div>

                <!-- Segunda fila: fechas -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Fecha de inicio</label>
                        <input
                            type="date"
                            class="form-control"
                            v-model="form.fecha_inicio"
                        />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Fecha de fin</label>
                        <input
                            type="date"
                            class="form-control"
                            v-model="form.fecha_fin"
                        />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Detalle de ubicación</label>
                        <textarea
                            class="form-control"
                            rows="2"
                            v-model="form.detalle_ubicacion"
                            placeholder="Dirección, referencia, ciudad, etc."
                        ></textarea>
                    </div>
                </div>

                <!-- Configuración de puntaje (mejor de 3) -->
                <hr />
                <h5 class="mb-3">Configuración de puntaje (sets al mejor de 3)</h5>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Victoria 2 - 0</label>
                        <div class="input-group">
                            <span class="input-group-text">Puntos</span>
                            <input
                                type="number"
                                min="0"
                                class="form-control"
                                v-model.number="form.puntos_victoria_2_0"
                            />
                        </div>
                        <small class="text-muted">PUNTOS_VICTORIA_2_0</small>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Victoria 2 - 1</label>
                        <div class="input-group">
                            <span class="input-group-text">Puntos</span>
                            <input
                                type="number"
                                min="0"
                                class="form-control"
                                v-model.number="form.puntos_victoria_2_1"
                            />
                        </div>
                        <small class="text-muted">PUNTOS_VICTORIA_2_1</small>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Derrota 1 - 2</label>
                        <div class="input-group">
                            <span class="input-group-text">Puntos</span>
                            <input
                                type="number"
                                min="0"
                                class="form-control"
                                v-model.number="form.puntos_derrota_1_2"
                            />
                        </div>
                        <small class="text-muted">PUNTOS_DERROTA_1_2</small>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Derrota 0 - 2</label>
                        <div class="input-group">
                            <span class="input-group-text">Puntos</span>
                            <input
                                type="number"
                                min="0"
                                class="form-control"
                                v-model.number="form.puntos_derrota_0_2"
                            />
                        </div>
                        <small class="text-muted">PUNTOS_DERROTA_0_2</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado simple de campeonatos -->
        <div class="card">
            <div class="card-header">
                Campeonatos registrados
            </div>
            <div class="card-body p-0">
                <div v-if="cargando" class="p-3">Cargando...</div>

                <table v-else class="table mb-0">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Deporte</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="c in campeonatos" :key="c.id_campeonato">
                        <td>{{ c.nombre_campeonato }}</td>
                        <td>{{ c.deporte }}</td>
                        <td>{{ c.fecha_inicio }}</td>
                        <td>{{ c.fecha_fin || '-' }}</td>
                        <td>
                            <button
                                class="btn btn-sm btn-outline-primary"
                                @click="editarCampeonato(c)"
                            >
                                Editar
                            </button>
                        </td>
                    </tr>
                    <tr v-if="!campeonatos.length">
                        <td colspan="5" class="text-center py-3">
                            No hay campeonatos registrados.
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
