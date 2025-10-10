<template>
  <section class="page-section bg-light" id="portfolio">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Nuestro Santuario</h2>
        <h3 class="section-subheading text-muted">
          Explora los rincones de nuestro santuario: espacios llenos de vida, historias de rescate y momentos que inspiran.
        </h3>
      </div>
      <div class="row">
        <div
          v-for="(item, index) in portfolioItems"
          :key="index"
          class="col-lg-4 col-sm-6 mb-4 d-flex"
        >
          <div class="portfolio-item w-100">
            <a class="portfolio-link" @click.prevent="openModal(item)">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fas fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" :src="item.image" :alt="item.title" />
            </a>
            <div class="portfolio-caption">
              <div class="portfolio-caption-heading">{{ item.title }}</div>
              <div class="portfolio-caption-subheading text-muted">{{ item.subtitle }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal con estilo original -->
    <div class="portfolio-modal modal fade" ref="portfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" v-if="activeItem">
          <div class="close-modal" data-bs-dismiss="modal">
            <img src="/public/assets/img/close-icon.svg" alt="Cerrar modal" />
          </div>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="modal-body">
                  <h2 class="text-uppercase">{{ activeItem.title }}</h2>
                  <p class="item-intro text-muted">{{ activeItem.subtitle }}</p>
                  <img class="img-fluid d-block mx-auto" :src="activeItem.image" :alt="activeItem.title" />
                  <p>
                    {{ activeItem.description || 'Esta historia representa el espíritu de nuestro santuario: compasión, esperanza y segundas oportunidades.' }}
                  </p>
                  <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                    <i class="fas fa-xmark me-1"></i> Cerrar historia
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Portfolio',
  data() {
    return {
      activeItem: null,
      portfolioItems: [
        {
          title: 'Viruta o Aserrín',
          subtitle: 'Donaciones que ayudan a mantener limpios los dormitorios de nuestros animales.',
          description: 'Cada semana necesitamos al menos 15 costales de viruta para evitar la mosca y mantener la higiene. ¡Tu ayuda hace la diferencia!',
          image: 'assets/img/portfolio/viruta.jpg',
        },
        {
          title: 'Desayunos solidarios',
          subtitle: 'Ven a desayunar y apoya la alimentación de más de 300 animales rescatados.',
          description: 'Servimos desayunos todos los domingos de 8:00 a 12:00 en Granja Los Fernandos, Km. 28.5 Interamericana. ¡Tu visita alimenta vidas!',
          image: 'assets/img/portfolio/luna.jpg',
        },
        {
          title: 'Atención veterinaria',
          subtitle: 'Ayuda urgente para cubrir la cuenta médica de Angelito.',
          description: 'Necesitamos reunir Q1,300 para su tratamiento. Puedes donar a la cuenta 07 20 725 de Industrial a nombre de Fernando Rendón. WhatsApp: 5691-1365.',
          image: 'assets/img/portfolio/atencionVeterinaria.jpg',
        },
        {
          title: '¡Residentes felices!',
          subtitle: 'Max y sus amigos disfrutan su nuevo espacio ampliado.',
          description: 'Gracias a tu apoyo, nuestros residentes tienen un hogar más grande, seguro y lleno de amor.',
          image: 'assets/img/portfolio/nuevoEspacio.jpg',
        },
        {
          title: 'La fuerza de Alma',
          subtitle: 'Una caballita que venció la enfermedad y nos inspira cada día.',
          description: 'Alma llegó débil, pero con cuidados y cariño superó todo. Hoy es símbolo de esperanza en el santuario.',
          image: 'assets/img/portfolio/caballos.jpg',
        },
        {
          title: 'Pequeños milagros',
          subtitle: 'El nacimiento de patitos en libertad nos recuerda que la vida florece donde hay paz.',
          description: 'Cada nuevo nacimiento en el santuario es una celebración de la vida y la protección que brindamos.',
          image: 'assets/img/portfolio/patitos.jpg',
        },
      ],
    };
  },
  methods: {
    openModal(item) {
      this.activeItem = item;
      const modal = new bootstrap.Modal(this.$refs.portfolioModal);
      modal.show();
    },
  },
};
</script>

<style scoped>
.portfolio-item {
  position: relative;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  height: 100%;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  overflow: hidden;
  transition: transform 0.3s ease;
}

.portfolio-item:hover {
  transform: translateY(-5px);
}

.portfolio-link {
  flex-grow: 1;
  display: block;
  height: 200px;
  overflow: hidden;
}

.portfolio-link img {
  object-fit: cover;
  width: 100%;
  height: 100%;
}

.portfolio-caption {
  padding: 15px;
  min-height: 140px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  text-align: center;
}

.portfolio-caption-heading {
  font-size: 1.1rem;
  font-weight: bold;
  margin-bottom: 5px;
}

.portfolio-caption-subheading {
  font-size: 0.9rem;
  color: #6c757d;
}

.portfolio-modal .modal-content {
  padding: 2rem;
  border-radius: 0.5rem;
}

.close-modal {
  position: absolute;
  right: 1rem;
  top: 1rem;
  cursor: pointer;
}
</style>
