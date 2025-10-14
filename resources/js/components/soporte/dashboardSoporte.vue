<template>
  <v-app>
    <v-container fluid>
      <!-- Encabezado -->
      <!-- <v-app-bar color="green-darken-2" dark>
        <v-app-bar-title>Santuario y Granja de Animales</v-app-bar-title>
      </v-app-bar> -->

      <!-- Tarjetas resumen -->
      <v-row class="mt-4" justify="center">
        <v-col cols="12" md="4">
          <v-card color="light-green lighten-4" class="pa-4">
            <v-card-title>🐮 Animales Totales</v-card-title>
            <v-card-text class="text-h5">{{ totalAnimales }}</v-card-text>
          </v-card>
        </v-col>
        <v-col cols="12" md="4">
          <v-card color="amber lighten-4" class="pa-4">
            <v-card-title>📅 Actividades Hoy</v-card-title>
            <v-card-text class="text-h5">{{ actividadesHoy.length }}</v-card-text>
          </v-card>
        </v-col>
        <v-col cols="12" md="4">
          <v-card color="cyan lighten-4" class="pa-4">
            <v-card-title>👥 Voluntarios Activos</v-card-title>
            <v-card-text class="text-h5">{{ voluntariosActivos }}</v-card-text>
          </v-card>
        </v-col>
      </v-row>

      <!-- Tabla de actividades -->
      <v-card class="mt-6">
        <v-card-title>Actividades Programadas</v-card-title>
        <v-data-table
          :headers="headers"
          :items="actividades"
          class="elevation-1"
          :items-per-page="5"
        >
          <template #item.fecha="{ item }">
            {{ new Date(item.fecha).toLocaleDateString() }}
          </template>
        </v-data-table>
      </v-card>
    </v-container>
  </v-app>
</template>

<script setup>
import { ref } from 'vue'

const totalAnimales = ref(128)
const voluntariosActivos = ref(12)

const actividadesHoy = ref([
  { nombre: 'Alimentación de caballos', responsable: 'Carlos', fecha: new Date() },
  { nombre: 'Limpieza de corrales', responsable: 'Ana', fecha: new Date() },
])

const actividades = ref([
  { nombre: 'Alimentación de caballos', responsable: 'Carlos', fecha: '2025-10-14' },
  { nombre: 'Limpieza de corrales', responsable: 'Ana', fecha: '2025-10-14' },
  { nombre: 'Revisión veterinaria', responsable: 'Dr. López', fecha: '2025-10-15' },
  { nombre: 'Paseo de ovejas', responsable: 'Lucía', fecha: '2025-10-16' },
])

const headers = [
  { title: 'Actividad', key: 'nombre' },
  { title: 'Responsable', key: 'responsable' },
  { title: 'Fecha', key: 'fecha' },
]
</script>

<style scoped>
.v-card-title {
  font-weight: bold;
}
</style>
