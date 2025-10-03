<template>
  <div>
    <component :is="currentComponent" />
  </div>
</template>

<script>
import Animales from './soporte/Animales.vue';
import Capacidad from './soporte/capacidad.vue';

export default {
  data() {
    return {
      currentComponent: document.getElementById('app').dataset.default || 'AnimalList'
    };
  },
  components: {
    Animales,
    Capacidad,
  },
  mounted() {
    document.addEventListener('selectComponent', (e) => {
      this.currentComponent = e.detail;
    });
  }
};
</script>
