import { createRouter, createWebHistory } from 'vue-router'

import CampeonatosView from '../views/CampeonatosView.vue'
import EquiposView from '../views/EquiposView.vue'
import JornadasView from '../views/JornadasView.vue'

const routes = [
    { path: '/configuracion/campeonato', component: CampeonatosView },
    { path: '/configuracion/equipo', component: EquiposView },
    { path: '/configuracion/jornada', component: JornadasView },
    { path: '/', redirect: '/configuracion/campeonato' }
]

const base = import.meta.env.VITE_APP_BASE_URL || '/'

const router = createRouter({
    history: createWebHistory(base),
    routes,
})

export default router
