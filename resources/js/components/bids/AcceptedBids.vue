<template>
    <div class="AcceptedBids" >
        <!---->
        <div class="vehicle_main_wrap" v-for="car in carList" :key="car.id">
            <div class="vehicle_lst">
                <div class="vehicle_mg">
                    <img :src="car.front_image" alt="front-image" height="130"/>
                </div>
                <div class="vehicle_cont">
                    <div class="vehicle_top">
                        <div class="audi_lst">
                            <div class="audi_mg">
                                <img src="/static/sellers/images/audicar.png"/>
                            </div>
                            <div class="audi_cont">
                                <!-- <h5>{{ car.name }} {{ car.brand_name }}</h5>
                                <span>{{ car.model_name }}</span> -->
                                <h5>{{ car.brand_name }} {{ car.model_name }}</h5>
                                <span>{{ car.model_year }}</span>
                            </div>
                        </div>

                        <div class="vehc_lst">
                            <span>Vehicle Price</span>
                            <div class="price">{{ `$${car.vehicle_price}` }}</div>
                        </div>
                        <!-- <div class="vehicle_btn">
                            <a href="#"><img src="/static/sellers/images/edit.png"/></a>
                        </div> -->
                    </div>

                    <div class="vehicle_btm">
                        <div class="comm_det">
                            <div class="comm_det_lft">
                                <img src="/static/sellers/images/user_ico.png"/>
                                <span>Buyer Name</span>
                            </div>
                            <div class="comm_det_rgt">
                                <span class="amt_blu">{{ car.buyer ? car.buyer.first_name : '' }}   <img src="/static/sellers/images/eye.png" class="eye_ico"/></span>

                            </div>


                        </div>
<!--                        <div class="comm_det">-->
<!--                            <div class="comm_det_lft">-->
<!--                                <img src="/static/sellers/images/bid.png"/>-->
<!--                                <span>Bid Price</span>-->
<!--                            </div>-->
<!--                            <div class="comm_det_rgt">-->
<!--                                <span class="amt_blu">$46,000</span>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="comm_det view_btn">
                            <a :href="`./vehicle-detail/${car.id}`">View More Detail</a>
                        </div>
                    </div>


                </div>
            </div>
            <div class="vehicle_tst ">
                <!--<div class="terms"><img src="/static/sellers/images/check.png"/>Terms and Conditions</div>-->
                <div class="adv">Advertisement ID - {{ car.advertisement_id}}</div>
            </div>
        </div>
        <div class="vehicle_main_wrap" v-if="carList.length < 1">
            <div class="vehicle_lst">
                <p>No data found</p>
            </div>
        </div>

    </div>
</template>


<script>
import CarApi from "../../api/CarApi";

export default {
    data() {
        return {
            carList: [],
            errors: []
        }
    },
    async created() {
        await this.getAcceptedBidding()
    },
    watch: {
        errors: function (error) {
            if(error.length > 0) {
                this.$_toast(error, 'error')
            }
        },
    },
    methods: {
        async getAcceptedBidding(params = null) {
            await CarApi.acceptedBids(params)
                .then(response => {
                    this.carList = response.data
                    this.errors = []
                })
                .catch(error => {
                    this.errors = error.response ? error.response.data.errors : []
                });
        },
    }
}
</script>
