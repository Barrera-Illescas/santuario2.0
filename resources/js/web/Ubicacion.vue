<template>
    <section class="page-section bg-light" id="ubicaciones">
        <div class="container">
            <!-- Encabezado -->
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Ubicación</h2>
                <h3 class="section-subheading text-muted">
                    Encuentra nuestros espacios de cuidado, rescate y educación animal.
                </h3>
            </div>

            <!-- Tarjetas de ubicación -->
            <div v-for="(grupo, rowIndex) in gruposDeUbicaciones" :key="rowIndex"
                class="row justify-content-center mb-4">
                <div v-for="(lugar, colIndex) in grupo" :key="colIndex"
                    class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center">
                    <div class="team-member text-center">
                        <img class="mx-auto rounded-circle" :src="lugar.imagen" :alt="lugar.nombre" />
                        <h4>{{ lugar.nombre }}</h4>
                        <p class="text-muted">{{ lugar.descripcion }}</p>
                        <button class="btn btn-dark btn-social mx-2" data-bs-toggle="modal"
                            :data-bs-target="'#modalMapa' + rowIndex + '-' + colIndex" aria-label="Ver en Google Maps">
                            <i class="fas fa-map-marker-alt"></i>
                        </button>

                        <!-- Modal del mapa -->
                        <div class="modal fade" :id="'modalMapa' + rowIndex + '-' + colIndex" tabindex="-1"
                            aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ lugar.nombre }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe :src="lugar.mapa" width="100%" height="450" style="border:0;"
                                            allowfullscreen="" loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin del modal -->
                    </div>
                </div>
            </div>

            <!-- Texto final -->
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="large text-muted">
                        Nuestro santuario se encuentra en San Lucas Sacatepéquez, rodeado de naturaleza y paz.
                        <!-- También colaboramos con centros educativos y veterinarios en otras regiones. -->
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Ubicaciones',
    data() {
        return {
            lugares: [
                {
                    nombre: 'Santuario Central',
                    descripcion: 'Refugio principal para animales rescatados, con áreas verdes y clínica veterinaria.',
                    imagen: '/assets/img/santuario/santuario.jpg',
                    mapa:
                        'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d229.68927165533339!2d-90.65608837118029!3d14.596677342392969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85890b27641c1f31%3A0x5448f53336483340!2sGranja%20los%20fernandos!5e1!3m2!1ses!2sgt!4v1759427428976!5m2!1ses!2sgt',
                },
            ],
        };
    },
    computed: {
        gruposDeUbicaciones() {
            const grupos = [];
            for (let i = 0; i < this.lugares.length; i += 3) {
                grupos.push(this.lugares.slice(i, i + 3));
            }
            return grupos;
        },
    },
};
</script>
