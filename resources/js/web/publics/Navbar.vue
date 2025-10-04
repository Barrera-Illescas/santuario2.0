<template>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand pacifico-text text-yellow-500 text-2xl" style="font-family: 'forte', cursive"
                href="#page-top"> Los Fernandos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="true" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#nosotros">Incio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Nuestro Santuario</a></li>
                    <li class="nav-item"><a class="nav-link" href="#historia">Historia</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ubicaciones">Visítanos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#apoyo">Sé parte del cambio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#denuncia">Denunciar</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" id="page-top">
        <div class="container">
            <div class="masthead-subheading">¡Un refugio de esperanza y amor!</div>
            <div class="masthead-heading text-uppercase">Bienvenido al Santuario Los Fernandos</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#nosotros">Conócenos</a>
        </div>
    </header>

    <!-- Services-->
    <section class="page-section" id="nosotros">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Nosotros</h2>
                <h3 class="section-subheading text-muted">Protegemos vidas, sembramos esperanza y construimos un hogar para quienes no tienen voz.</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-danger"></i>
                        <i class="fas fa-heart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Misión</h4>
                    <p class="text-muted">Resguardar con amor, proteger, alimentar, proveer para todas las necesidades de todas las criaturas quen han hecho de este santuario su hogar
                        y de las que se vayan a agregar.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-success"></i>
                        <i class="fas fa-seedling fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Visión</h4>
                    <p class="text-muted">Tener el espacio adecuadoofrecer a nuestros refugiados el hogar que se merecen y la vida digna a la cuál tiene derecho todo ser vivo.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-warning"></i>
                        <i class="fas fa-paw fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Valores</h4>
                    <p class="text-muted">Compasión, respeto, responsabilidad, empatía y compromiso. Cada acción que tomamos está guiada por el amor hacia los animales y el deseo de construir un mundo más justo para ellos.</p>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: 'navbar-component'
}
</script>