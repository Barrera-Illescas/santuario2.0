<template>
  <section class="page-section text-white" id="denuncia" style="background-color: #1c1c1e;">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Denuncia Maltrato Animal</h2>
        <h3 class="section-subheading text-muted text-white-50">
          Si presenciaste o sospechas de un caso de maltrato, negligencia o abandono, actúa. Tu voz puede salvar vidas.
        </h3>
      </div>

      <div class="row align-items-stretch mb-5">
        <div class="col-md-12">
          <div class="form-group text-center">
            <h4 class="mb-3">Denuncia vía WhatsApp</h4>
            <a
              :href="whatsappDenuncia"
              target="_blank"
              class="btn btn-outline-danger btn-xl text-uppercase"
              aria-label="Denunciar por WhatsApp"
            >
              <i class="fab fa-whatsapp me-2"></i> Enviar denuncia
            </a>
            <p class="mt-3 text-white-50">
              Puedes enviar fotos, ubicación y detalles del caso. Toda denuncia es tratada con confidencialidad y respeto.
            </p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <p class="large text-white-50">
            En Los Fernandos creemos que el silencio perpetúa el sufrimiento. Gracias por alzar la voz por quienes no pueden hacerlo.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Denuncia',
  data() {
    return {
      whatsappDenuncia: 'https://wa.me/50212345678?text=Hola%2C%20quiero%20reportar%20un%20caso%20de%20maltrato%20animal',
    };
  },
};
</script>
