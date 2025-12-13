<template>
    <div class="container mt-4">
        <h1 class="mb-4">Gestor de Campeonatos</h1>

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <RouterLink
                    to="/configuracion/campeonato"
                    class="nav-link"
                    active-class="active"
                >
                    Campeonatos
                </RouterLink>
            </li>
            <li class="nav-item">
                <RouterLink
                    to="/configuracion/equipo"
                    class="nav-link"
                    active-class="active"
                >
                    Equipos
                </RouterLink>
            </li>
            <li class="nav-item">
                <RouterLink
                    to="/configuracion/jornada"
                    class="nav-link"
                    active-class="active"
                >
                    Jornadas
                </RouterLink>
            </li>
        </ul>

        <RouterView />
    </div>
</template>

<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>
