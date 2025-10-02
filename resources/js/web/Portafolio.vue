<!-- resources/js/components/Portfolio.vue -->
<template>
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Nuestro Santuario</h2>
                <h3 class="section-subheading text-muted">Explora los rincones de nuestro santuario: espacios llenos de vida, historias de rescate y momentos que inspiran.</h3>
            </div>
            <div class="row">
                <div v-for="(item, index) in portfolioItems" :key="index" class="col-lg-4 col-sm-6 mb-4"
                    :class="{ 'mb-lg-0': index === 3, 'mb-sm-0': index === 4 }">
                    <div class="portfolio-item">
                        <a class="portfolio-link" :data-bs-toggle="'modal'" :href="item.modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid" :src="item.image" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">{{ item.title }}</div>
                            <div class="portfolio-caption-subheading text-muted">{{ item.subtitle }}</div>
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
            portfolioItems: [
                {
                    title: 'Threads',
                    subtitle: 'Illustration',
                    image: 'assets/img/portfolio/1.jpg',
                    modal: '#portfolioModal1',
                },
                {
                    title: 'Explore',
                    subtitle: 'Graphic Design',
                    image: 'assets/img/portfolio/2.jpg',
                    modal: '#portfolioModal2',
                },
                {
                    title: 'Finish',
                    subtitle: 'Identity',
                    image: 'assets/img/portfolio/3.jpg',
                    modal: '#portfolioModal3',
                },
                {
                    title: 'Lines',
                    subtitle: 'Branding',
                    image: 'assets/img/portfolio/4.jpg',
                    modal: '#portfolioModal4',
                },
                {
                    title: 'Southwest',
                    subtitle: 'Website Design',
                    image: 'assets/img/portfolio/5.jpg',
                    modal: '#portfolioModal5',
                },
                {
                    title: 'Window',
                    subtitle: 'Photography',
                    image: 'assets/img/portfolio/6.jpg',
                    modal: '#portfolioModal6',
                },
            ],
        };
    },
};
</script>
