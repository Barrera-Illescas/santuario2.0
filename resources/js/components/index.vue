<template>
  <div>
    <component :is="currentComponent" />
  </div>
</template>

<script>
import dashboardSoporte from './soporte/dashboardSoporte.vue';
import Animales from './soporte/Animales.vue';
import Capacidad from './soporte/Capacidad.vue';
import Donantes from './soporte/Donantes.vue';
import Donaciones from './soporte/Donaciones.vue';
import Gastos from './soporte/Gastos.vue';
import CategoriaGastos from './soporte/CategoriaGastos.vue';
import AsignacionEspacios from './soporte/AsignacionEspacios.vue';
import CategoriaPortafolio from './soporte/CategoriaPortafolio.vue';
import Portafolio from './soporte/Portafolio.vue';

export default {
  data() {
    return {
      currentComponent: document.getElementById('app').dataset.default || 'AnimalList'
    };
  },
  components: {
    dashboardSoporte,
    Animales,
    Capacidad,
    Donantes,
    Donaciones,
    Gastos,
    CategoriaGastos,
    AsignacionEspacios,
    CategoriaPortafolio,
    Portafolio,
  },
  mounted() {
    document.addEventListener('selectComponent', (e) => {
      this.currentComponent = e.detail;
    });
  }
};
</script>
