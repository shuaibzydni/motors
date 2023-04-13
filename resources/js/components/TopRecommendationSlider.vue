<template>
    <div id="testimonial-slider1">
        <splide :options="options">
            <splide-slide v-for="car in recommendations" :key="car.id">
                <div class="testimonial">
                    <div class="rcdt_grd">
                        <div class="rcdt_ddt">
                            <img :src="car.front_image" alt="icn">
                            <div class="rcdt_rcd">
                                <div class="rcd_dts">
                                    <span>{{ car.published_at }}</span>
<!--                                    <div class="fav_rte">-->
<!--                                        <input checked type="checkbox" name="rate" id="rate11">-->
<!--                                        <label for="rate11">-->
<!--                                            <img src="/images/icons/heart.png" alt="icn">-->
<!--                                        </label>-->
<!--                                    </div>-->
                                </div>
                                <span class="crnme">{{ car.brand_name }} - {{ car.model_name }}</span>
                                <span class="crnmdl">{{ car.model_year }}</span>
                                <div class="cr_prc">
                                    <div class="crprc_cd">
                                        <label>Vehicle Price</label>
                                        <span>{{ car.vehicle_price }}</span>
                                    </div>
                                    <button @click="navigateToVehicleDetail(car.id)" class="btn_secondary">See More Detail</button>
                                </div>
                            </div>
                        </div>
                        <div class="rcdt_lst">
                            <ul>
                                <li><img src="/static/buyers/images/icons/petrol.png" alt="icn">
                                    <span>{{ car.fuel_type }}</span>
                                </li>
                                <li><img src="/static/buyers/images/icons/automation_ic.png" alt="icn">
                                    <span>{{ car.drive_type }}</span>
                                </li>
                                <li><img src="/static/buyers/images/icons/speed_ic.png" alt="icn">
                                    <span>{{ car.odometer_mileage }} KM</span>
                                </li>
                                <li><img src="/static/buyers/images/icons/car_ic.png" alt="icn">
                                    <span>{{ car.transmission }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </splide-slide>
        </splide>
    </div>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide'
import '@splidejs/splide/dist/css/themes/splide-default.min.css'
export default {
    name: 'TopRecommendationSlider',
    components: {
        Splide,
        SplideSlide,
    },
    data() {
        return {
            recommendations: this.$attrs.recommendations,
            options: {
                classes: {
                    arrow : 'splide__arrow top-recommendation-arrow',
                    prev  : 'splide__arrow--prev top-recommendation-prev',
                    next  : 'splide__arrow--next top-recommendation-next',
                },
                rewind : true,
                perPage    : 2,
                breakpoints: {
                    600: {
                        perPage: 1,
                    }
                }
            }
        }
    },
    methods: {
        navigateToVehicleDetail(carId) {
            window.location = `/vehicle-detail/${carId}`
        }
    }
}
</script>

<style>
.top-recommendation-arrow {
    top: 43% !important;
}
.top-recommendation-prev {
    left: -3em !important;
}
.top-recommendation-next {
    right: -2em !important;
}
</style>
