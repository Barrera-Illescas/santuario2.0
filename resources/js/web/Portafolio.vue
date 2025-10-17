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
          class="col-lg-4 col-sm-6 mb-4 d-flex">
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
      portfolioItems: [],
    };
  },
  methods: {
    openModal(item) {
      this.activeItem = item;
      const modal = new bootstrap.Modal(this.$refs.portfolioModal);
      modal.show();
    },
    getPortfolioItems() {
      axios.get('/portafolio/listar')
        .then(response => {
          this.portfolioItems = response.data;
        })
        .catch(error => {
          console.error('Error al cargar portafolio:', error);
        });
    }
  },
  mounted() {
    this.getPortfolioItems();
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
