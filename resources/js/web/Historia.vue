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
                    image: 'assets/img/about/1.jpg',
                    inverted: false,
                    panel: {
                        date: '2009-2011',
                        title: 'Our Humble Beginnings',
                        description:
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente...',
                    },
                },
                {
                    image: 'assets/img/about/2.jpg',
                    inverted: true,
                    panel: {
                        date: 'March 2011',
                        title: 'An Agency is Born',
                        description:
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente...',
                    },
                },
                {
                    image: 'assets/img/about/3.jpg',
                    inverted: false,
                    panel: {
                        date: 'December 2015',
                        title: 'Transition to Full Service',
                        description:
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente...',
                    },
                },
                {
                    image: 'assets/img/about/4.jpg',
                    inverted: true,
                    panel: {
                        date: 'July 2020',
                        title: 'Phase Two Expansion',
                        description:
                            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente...',
                    },
                },
                {
                    image: null,
                    inverted: true,
                    text: 'Be Part<br />Of Our<br />Story!',
                    panel: null,
                },
            ],
        };
    },
};
</script>
