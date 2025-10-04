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
          class="col-lg-4 col-sm-6 mb-4"
          :class="{ 'mb-lg-0': index === 3, 'mb-sm-0': index === 4 }"
        >
          <div class="portfolio-item">
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
            <!-- <img src="assets/img/close-icon.svg" alt="Cerrar modal" /> -->
          </div>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="modal-body">
                  <!-- Detalles del proyecto -->
                  <h2 class="text-uppercase">{{ activeItem.title }}</h2>
                  <p class="item-intro text-muted">{{ activeItem.subtitle }}</p>
                  <img class="img-fluid d-block mx-auto" :src="activeItem.image" :alt="activeItem.title" />
                  <p>
                    {{ activeItem.description || 'Esta historia representa el espíritu de nuestro santuario: compasión, esperanza y segundas oportunidades.' }}
                  </p>
                  <ul class="list-inline">
                    <li><strong>Cliente:</strong> Santuario Animal</li>
                    <li><strong>Categoría:</strong> Historia de rescate</li>
                  </ul>
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
          title: 'El renacer de Luna',
          subtitle: 'Una perrita rescatada de la calle que encontró amor, cuidados y una nueva familia en el santuario.',
          image: 'assets/img/portfolio/1.jpg',
        },
        {
          title: 'Esperanza en la tormenta',
          subtitle: 'Durante una fuerte lluvia, voluntarios salvaron a varias aves atrapadas en el lodo, dándoles una segunda oportunidad.',
          image: 'assets/img/portfolio/2.jpg',
        },
        {
          title: 'Max vuelve a galopar',
          subtitle: 'Un caballo maltratado que llegó débil y temeroso, hoy corre libre gracias a meses de rehabilitación y cariño.',
          image: 'assets/img/portfolio/3.jpg',
        },
        {
          title: 'Voces que inspiran',
          subtitle: 'Historias reales de voluntarios que transformaron su vida al cuidar y proteger animales vulnerables.',
          image: 'assets/img/portfolio/4.jpg',
        },
        {
          title: 'La fuerza de Alma',
          subtitle: 'Una cerdita enferma que superó las expectativas médicas y se convirtió en símbolo de resiliencia en el santuario.',
          image: 'assets/img/portfolio/5.jpg',
        },
        {
          title: 'Pequeños milagros',
          subtitle: 'El nacimiento inesperado de cabritos en libertad, celebrando la vida en medio de la naturaleza protegida.',
          image: 'assets/img/portfolio/6.jpg',
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
}
.portfolio-hover {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: all 0.3s ease;
  background-color: rgba(0, 0, 0, 0.5);
}
.portfolio-item:hover .portfolio-hover {
  opacity: 1;
}
.portfolio-hover-content {
  position: absolute;
  width: 100%;
  height: 100%;
  text-align: center;
  top: 50%;
  transform: translateY(-50%);
  color: white;
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
