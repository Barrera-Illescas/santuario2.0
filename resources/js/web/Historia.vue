<!-- resources/js/components/About.vue -->
<template>
    <section class="page-section" id="historia">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Historia</h2>
                <h3 class="section-subheading text-muted">Desde un gesto de compasión hasta un movimiento de esperanza: descubre cómo nació y creció nuestro santuario.</h3>
            </div>
            <ul class="timeline">
                <li v-for="(item, index) in timeline" :key="index" :class="{ 'timeline-inverted': item.inverted }">
                    <div class="timeline-image">
                        <img v-if="item.image" class="rounded-circle img-fluid" :src="item.image" alt="..." />
                        <h4 v-else v-html="item.text"></h4>
                    </div>
                    <div v-if="item.panel" class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>{{ item.panel.date }}</h4>
                            <h4 class="subheading">{{ item.panel.title }}</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="text-muted">{{ item.panel.description }}</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
export default {
    name: 'About',
    data() {
        return {
            timeline: [
                {
                    image: 'assets/img/about/ovejas.jpg',
                    inverted: false,
                    panel: {
                        date: 'Un día cualquiera',
                        title: 'Un encuentro inesperado',
                        description:
                            'Una familia vio a un señor ciego buscando comida entre la basura, acompañado de unas ovejitas. Aunque continuaron su camino, el pesar quedó en sus corazones.',
                    },
                },
                {
                    image: 'assets/img/about/ganzo.jpg',
                    inverted: true,
                    panel: {
                        date: 'Pocos días después',
                        title: 'La conversación que lo cambió todo',
                        description:
                            'La familia regresó y habló con el señor, quien explicó que, debido a su ceguera, no podía alimentar adecuadamente a sus ovejitas, aunque las amaba profundamente.',
                    },
                },
                {
                    image: 'assets/img/about/tortuguita.jpg',
                    inverted: false,
                    panel: {
                        date: 'La tercera visita',
                        title: 'Un gesto de amor y confianza',
                        description:
                            'Se acordó que el señor entregaría a sus ovejitas a cambio de medicamentos y un poco de dinero. Así, con respeto y gratitud, comenzó una nueva etapa para ellas.',
                    },
                },
                {
                    image: 'assets/img/about/cabra.jpg',
                    inverted: true,
                    panel: {
                        date: 'Nacimiento del santuario',
                        title: 'Granja Los Fernandos',
                        description:
                            'Ese acto de compasión fue la semilla que dio vida al santuario. Desde entonces, "Los Fernandos" ha crecido como un refugio para cientos de animales que hoy viven con dignidad.',
                    },
                },
                {
                    image: null,
                    inverted: true,
                    text: 'Sé parte<br />de nuestra<br />historia',
                    panel: null,
                },
            ],
        };
    },
};
</script>
<style>
.timeline-image {
  position: relative;
  width: 150px;
  height: 150px;
  margin: 0 auto;
  background-color: #f1f1f1;
  border-radius: 50%;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.timeline-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}
</style>