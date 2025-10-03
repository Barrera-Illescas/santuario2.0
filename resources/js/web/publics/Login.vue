<template>
    <div class="row d-flex justify-content-center align-items-center min-vh-100 position-relative">
        <!-- Overlay de carga -->
        <v-overlay v-model="overlay" class="d-flex align-center justify-center" persistent>
            <v-progress-circular :width="12" :size="85" color="#004080" indeterminate />
        </v-overlay>

        <div class="col-xl-10">
            <div class="card rounded-3 text-black shadow-lg">
                <div class="row g-0">
                    <!-- Formulario de login -->
                    <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center mb-4">
                                <img src="/public/assets/img/logo.png" style="width: 185px;" alt="Logo Los Fernandos" />
                                <h4 class="mt-3 mb-5 pb-1">Santuario Los Fernandos</h4>
                            </div>

                            <form @submit.prevent="handleLogin">
                                <p class="mb-4">Por favor, inicia sesión</p>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example11">Usuario</label>
                                    <input v-model="user" type="email" id="form2Example11" class="form-control"
                                        placeholder="email" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example22">Contraseña</label>
                                    <input v-model="password" type="password" id="form2Example22" class="form-control"
                                        required />
                                </div>

                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                        type="submit">
                                        Iniciar Sesión
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Mensaje emocional -->
                    <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                            <h4 class="mb-4">Más que un santuario, somos un hogar</h4>
                            <p class="small mb-0">
                                En Los Fernandos, cada animal rescatado encuentra una segunda oportunidad.
                                Nuestro equipo trabaja con amor, compromiso y respeto para sanar heridas físicas y
                                emocionales.
                                Al iniciar sesión, formas parte de esta misión: proteger, rehabilitar y transformar
                                vidas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';

export default {
    name: 'Login',
    data() {
        return {
            overlay: false,
            user: '',
            password: '',
        };
    },
    methods: {
        async handleLogin() {
            this.overlay = true;
            this.error = null;

            try {
                await axios.post('/login', {
                    email: this.user,
                    password: this.password,
                }, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                // Login exitoso
                this.overlay = false;
                Swal.fire({
                    title: 'Bienvenido',
                    text: 'Gracias por alzar la voz por los animales.',
                    icon: 'success',
                    confirmButtonText: 'Continuar',
                }).then(() => {
                    window.location.href = '/dashboard';
                });

            } catch (error) {
                this.overlay = false;
                Swal.fire({
                    icon: 'error',
                    title: 'Credenciales incorrectas',
                    text: 'Por favor, inténtelo de nuevo'
                });
            }
        }

    }
}
</script>