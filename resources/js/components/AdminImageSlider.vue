<template>
    <div class="card-body">
        <splide id="primary-slider" :options="slider.primaryOptions" ref="primary">
            <splide-slide v-if="carData.front_image">
                <img :src="carData.front_image" alt="car">
            </splide-slide>
            <splide-slide v-if="carData.rear_image">
                <img :src="carData.rear_image" alt="car">
            </splide-slide>
            <splide-slide v-if="carData.left_side_image">
                <img :src="carData.left_side_image" alt="car">
            </splide-slide>
            <splide-slide v-if="carData.interior_image">
                <img :src="carData.interior_image" alt="car">
            </splide-slide>
            <splide-slide v-if="carData.cargo_area_image">
                <img :src="carData.cargo_area_image" alt="car">
            </splide-slide>
            <splide-slide v-if="carData.engine_bay_image">
                <img :src="carData.engine_bay_image" alt="car">
            </splide-slide>
            <splide-slide v-if="carData.roof_image">
                <img :src="carData.roof_image" alt="car">
            </splide-slide>
            <splide-slide v-if="carData.wheels_image">
                <img :src="carData.wheels_image" alt="car">
            </splide-slide>
            <splide-slide v-if="carData.keys_image">
                <img :src="carData.keys_image" alt="car">
            </splide-slide>
        </splide>
        <splide id="secondary-slider" :options="slider.secondaryOptions" ref="secondary">
            <splide-slide v-if="carData.front_image">
                <img :src="carData.front_image" alt="car">
                <span>Overview</span>
            </splide-slide>
            <splide-slide v-if="carData.rear_image">
                <img :src="carData.rear_image" alt="car">
                <span>Rear</span>
            </splide-slide>
            <splide-slide v-if="carData.left_side_image">
                <img :src="carData.left_side_image" alt="car">
                <span>Side View</span>
            </splide-slide>
            <splide-slide v-if="carData.interior_image">
                <img :src="carData.interior_image" alt="car">
                <span>Side</span>
            </splide-slide>
            <splide-slide v-if="carData.cargo_area_image">
                <img :src="carData.cargo_area_image" alt="car">
                <span>Back</span>
            </splide-slide>
            <splide-slide v-if="carData.engine_bay_image">
                <img :src="carData.engine_bay_image" alt="car">
                <span>Overview</span>
            </splide-slide>
            <splide-slide v-if="carData.roof_image">
                <img :src="carData.roof_image" alt="car">
                <span>Rear</span>
            </splide-slide>
            <splide-slide v-if="carData.wheels_image">
                <img :src="carData.wheels_image" alt="car">
                <span>Overview</span>
            </splide-slide>
            <splide-slide v-if="carData.keys_image">
                <img :src="carData.keys_image" alt="car">
                <span>Back</span>
            </splide-slide>
        </splide>
    </div>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/splide/dist/css/themes/splide-default.min.css';
export default {
    components: {
        Splide,
        SplideSlide,
    },
    data() {
        return {
            carData: this.$attrs.cardata,
            slider: {
                primaryOptions: {
                    type       : 'fade',
                    heightRatio: 0.5,
                    pagination : false,
                    arrows     : false,
                    cover      : true,
                },
                secondaryOptions: {
                    fixedWidth  : 110,
                    height      : 100,
                    gap         : 10,
                    cover       : true,
                    isNavigation: true,
                    focus       : 'center',
                    pagination : false,
                    breakpoints : {
                        '600': {
                            fixedWidth: 100,
                            height    : 80,
                        }
                    },
                }
            }
        }
    },
    mounted() {
        this.$refs.primary.sync( this.$refs.secondary.splide );
    },
}
</script>
