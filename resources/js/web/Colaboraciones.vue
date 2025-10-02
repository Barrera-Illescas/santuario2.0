<template>
  <section class="page-section" id="apoyo">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Cómo puedes ayudar</h2>
        <h3 class="section-subheading text-muted">
          Tu apoyo hace posible nuestra misión de rescate, rehabilitación y educación.
        </h3>
      </div>

      <div class="row align-items-stretch mb-5">
        <div class="col-md-4 col-sm-6 my-3 text-center">
          <a
            :href="whatsappVoluntariado"
            target="_blank"
            class="btn btn-outline-success btn-lg"
            aria-label="Unirse como voluntario vía WhatsApp"
          >
            <i class="fab fa-whatsapp me-2"></i> Quiero ser voluntario
          </a>
          <p class="mt-3 text-muted">
            Únete a nuestro equipo de voluntarios y transforma vidas con tu tiempo y energía.
          </p>
        </div>

        <!-- Donaciones vía PayPal -->
        <div class="col-md-4 col-sm-6 my-3 text-center">
          <a
            :href="paypalDonacion"
            target="_blank"
            class="btn btn-outline-primary btn-lg"
            aria-label="Donar vía PayPal"
          >
            <i class="fab fa-paypal me-2"></i> Donar con PayPal
          </a>
          <p class="mt-3 text-muted">
            Cada donación nos ayuda a alimentar, cuidar y proteger a nuestros animales rescatados.
          </p>
        </div>

        <!-- Donaciones vía WhatsApp -->
        <div class="col-md-4 col-sm-6 my-3 text-center">
          <a
            :href="whatsappDonacion"
            target="_blank"
            class="btn btn-outline-success btn-lg"
            aria-label="Donar vía WhatsApp"
          >
            <i class="fab fa-whatsapp me-2"></i> Donar por WhatsApp
          </a>
          <p class="mt-3 text-muted">
            Si prefieres donar directamente o necesitas ayuda, contáctanos por WhatsApp.
          </p>
        </div>
      </div>

      <!-- Mensaje final -->
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <p class="large text-muted">
            Gracias por ser parte de esta misión. Tu acción, por pequeña que parezca, tiene un impacto inmenso.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Apoyo',
  data() {
    return {
      whatsappVoluntariado: 'https://wa.me/50212345678?text=Hola%2C%20quiero%20ser%20voluntario',
      paypalDonacion: 'https://www.paypal.com/donate/?hosted_button_id=XXXXXXXXXXXX',
      whatsappDonacion: 'https://wa.me/50212345678?text=Hola%2C%20quiero%20hacer%20una%20donación%20al%20santuario',
    };
  },
};
</script>
