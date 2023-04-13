<template>
    <div class="brsr_vhle_wrp">
        <div class="container_sub">
            <div class="brsr_vhlee">
                <div class="bsr_vhdtl">
                    <div class="vhl_glrys">
<!--                        <span class="fetrs">Featured</span>-->
<!--                        <div class="fav_bsr">-->
<!--                            <div class="fav_rte">-->
<!--                                <input checked="" type="checkbox" name="rate" id="rate1">-->
<!--                                <label for="rate1">-->
<!--                                    <img src="/static/buyers/images/icons/heart.png" alt="icn">-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->

                        <div class="lightSlider">
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
                                    <span>Interior</span>
                                </splide-slide>
                                <splide-slide v-if="carData.cargo_area_image">
                                    <img :src="carData.cargo_area_image" alt="car">
                                    <span>Cargo Area</span>
                                </splide-slide>
                                <splide-slide v-if="carData.engine_bay_image">
                                    <img :src="carData.engine_bay_image" alt="car">
                                    <span>Engine Bay</span>
                                </splide-slide>
                                <splide-slide v-if="carData.roof_image">
                                    <img :src="carData.roof_image" alt="car">
                                    <span>Roof</span>
                                </splide-slide>
                                <splide-slide v-if="carData.wheels_image">
                                    <img :src="carData.wheels_image" alt="car">
                                    <span>Wheels</span>
                                </splide-slide>
                                <splide-slide v-if="carData.keys_image">
                                    <img :src="carData.keys_image" alt="car">
                                    <span>Key Image</span>
                                </splide-slide>
                            </splide>
                        </div>

                    </div>
                    <div class="vhile_pcf">
                        <div class="vhile_sts">
                            <span>Vehicle Price</span>
                            <strong>{{ `$${carData.vehicle_price}` }}</strong>
                            <div class="vhile_cntpci">
                                <span>Vehicle Status</span>
                                <strong>{{ getVehicleStatus(carData.vehicle_status).value }}</strong>
                            </div>
                        </div>
                        <div class="vhile_tss">
                            <h4>{{ carData.brand_name }} {{ carData.model_name }}</h4>
                            <span>{{ carData.model_year }}</span>

                            <template v-if="isUserLoggedIn">
                                <template v-if="isSubscriptionEnded">
                                    <div class="lsvtt_btn">
                                        <button class="btn_secondary modal-toggle" @click="gotoPricingPlanPage()">
                                            Subscription Expired/Limit Ended
                                        </button>
                                    </div>
                                </template>
                                <template v-else>
                                    <template v-if="!acceptedBid">
                                        <div>
                                            <button class="btn_primary flx_dt" v-if="!bidNow" @click="bidNow = true"><img src="/static/buyers/images/icons/auction.svg" alt="icn" />BID NOW</button>
                                        </div>
                                        <br />
                                        <div v-if="biddingDetail">
                                            <button class="btn_primary flx_dt" @click.prevent="$_confirm('Active Bid', 'You already have an active bid. To place another bid, click on BID NOW button.', 'warning', 'Close', false)">
                                                <img src="/static/buyers/images/icons/auction.svg" alt="icn" />
                                                {{ seller.text }}: {{ `$${biddingDetail.bid_price}` }}
                                            </button>
                                        </div>
                                        <div class="bid_price">
                                            <form novalidate v-if="bidNow" @submit.prevent="submitForm(payload)">
                                                <input class="text-box" type="text" placeholder="Your Bid Price?" v-model="payload.bid_price" :max="carData.vehicle_price">
                                                <p class="invalid-msg" v-if="formErrors.bid_price">{{ formErrors.bid_price[0] }}</p>
                                                <input class="btn success" type="submit" value="Submit" />
                                                <input class="btn secondary" type="reset" value="Cancel" @click="bidNow = false" />
                                            </form>
                                        </div>
                                    </template>
                                </template>
                            </template>
                            <template v-else>
                                <div class="lsvtt_btn">
                                    <button class="btn_secondary modal-toggle" @click="gotoLoginPage()">
                                        Login to Bid
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div class="vhile_ovrwn">
                        <h3>Vehicle Overview</h3>
                        <div class="vhilehdr">
                            <div class="vhiledr_wrp">
                                <label>Make</label>
                                <span>{{ carData.brand_name }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Body Type</label>
                                <span>{{ carData.body_type }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Model</label>
                                <span>{{ carData.model_name }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Model Description</label>
                                <span>{{ carData.model_description }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Model Year</label>
                                <span>{{ carData.model_year }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Transmission</label>
                                <span>{{ carData.transmission }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Drive Type</label>
                                <span>{{ carData.drive_type }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Fuel Type</label>
                                <span>{{ carData.fuel_type }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Service Log Book</label>
                                <span><a target="_blank" v-if="carData.service_log_book" :href="carData.service_log_book">{{ `view` }}</a></span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Owner's Manual</label>
                                <span><a target="_blank" v-if="carData.owners_manual" :href="carData.owners_manual">{{ `view` }}</a></span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Current Odometer/
                                    Mileage</label>
                                <span>{{ carData.odometer_mileage }}KM</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Vehicle VIN</label>
                                <span>{{ carData.vehicle_vin }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Vehicle Price</label>
                                <span class="txt-ble">{{ `$${carData.vehicle_price}` }}</span>
                            </div>
                            <div class="vhiledr_wrp">
                                <label>Vehicle Status</label>
                                <span class="txt-grn">{{ getVehicleStatus(carData.vehicle_status).value }}</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="bsr_vhaside">
                    <div class="lct_whside">
                        <img src="/static/buyers/images/icons/gry_lct.png" alt="icn">
                        <span>{{ seller.address_line }}</span>
                    </div>
                    <div class="bsr_gdgt">
                        <h4>Gadgets</h4>
                        <div class="grd_gdgt">
                            <div class="grd_img"> <img src="/static/buyers/images/gpump.png" alt="icn" /></div>
                            <div class="grdgrt_cnt">
                                <label>Fuel Type</label>
                                <p>{{ carData.fuel_type }}</p>
                            </div>
                        </div>
                        <div class="grd_gdgt">
                            <div class="grd_img"> <img src="/static/buyers/images/gspreed.png" alt="icn" /></div>
                            <div class="grdgrt_cnt">
                                <label>Odometer</label>
                                <p>{{ carData.odometer_mileage }} KM</p>
                            </div>
                        </div>
                        <div class="grd_gdgt">
                            <div class="grd_img"> <img src="/static/buyers/images/gauto.png" alt="icn" /></div>
                            <div class="grdgrt_cnt">
                                <label>Transmission</label>
                                <p>{{ carData.transmission }}</p>
                            </div>
                        </div>
                        <div class="grd_gdgt">
                            <div class="grd_img"> <img src="/static/buyers/images/gcar.png" alt="icn" /></div>
                            <div class="grdgrt_cnt">
                                <label>Drive Type</label>
                                <p>{{ carData.drive_type }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="grd_vhidtls">
                        <div class="grn_hrdvhil">
                            <h3>Vehicle Owner Detail</h3>
                            <div class="hrinf">
                                <img src="/static/buyers/images/icons/info_.png" alt="icn">
                                <span>Vehicle Owner detail will be show once he is accepted your BID!

                                    </span>
                            </div>
                        </div>
                        <div class="onr_dt">
                            <div class="own_pst">
                                <div class="own_prf">
                                    <img src="/static/buyers/images/icons/wnpr.png" alt="icn">
                                </div>
                                <div class="own_dtls">
                                    <label>Posted by</label>
                                    <h5>{{ seller.name }}</h5>
                                    <div class="own_crd">
                                        <span style="display: block">{{ seller.business_name }}</span>
                                        <span style="display: block">{{ seller.business_email }}</span>
                                        <span style="display: block">{{ seller.business_phone }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ownr_st">
                                <span>Posted on : {{ carData.published_at }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="lsbadv_id">
                        <label>Advertisement ID</label>
                        <span>{{ carData.advertisement_id }}</span>
                    </div>
                    <div class="lsbttbid">
                        <label>No. of Total Bids</label>
                        <span>{{ biddingCount }}</span>
                    </div>
                    <template v-if="isUserLoggedIn">
                        <template v-if="isSubscriptionEnded">
                            <div class="lsvtt_btn">
                                <button class="btn_secondary modal-toggle" @click="gotoPricingPlanPage()">
                                    Subscription Expired/Limit Ended
                                </button>
                            </div>
                        </template>
                        <template v-else>
                            <template v-if="!acceptedBid">
                                <div class="lsvtt_btn">
                                    <button class="btn_secondary modal-toggle" v-if="!bidNow" @click="bidNow = true">
                                        <img src="/static/buyers/images/icons/hmb_ble.png" alt="icn"> BID NOW
                                    </button>
                                    <div class="bid_price">
                                        <form novalidate v-if="bidNow" @submit.prevent="submitForm(payload)">
                                            <input class="text-box" type="text" placeholder="Your Bid Price?" v-model="payload.bid_price" :max="carData.vehicle_price">
                                            <p class="invalid-msg" v-if="formErrors.bid_price">{{ formErrors.bid_price[0] }}</p>
                                            <input class="btn success" type="submit" value="Submit" />
                                            <input class="btn secondary" type="reset" value="Cancel" @click="bidNow = false" />
                                        </form>
                                    </div>
                                </div>
                                <div class="lsvtt_btn" v-if="biddingDetail">
                                    <button class="btn_secondary modal-toggle" @click.prevent="$_confirm('Active Bid', 'You already have an active bid. To place another bid, click on BID NOW button.', 'warning', 'Close', false)">
                                        <img src="/static/buyers/images/icons/hmb_ble.png" alt="icn"> {{ seller.text }}: {{ `$${biddingDetail.bid_price}` }}
                                    </button>
                                </div>
                            </template>
                        </template>
                    </template>
                    <template v-else>
                        <div class="lsvtt_btn">
                            <button class="btn_secondary modal-toggle" @click="gotoLoginPage()">
                                Login to Bid
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import '@splidejs/splide/dist/css/themes/splide-default.min.css';
import BidApi from "../api/BidApi";

export default {
    components: {
        Splide,
        SplideSlide,
    },
    data() {
        return {
            payload: {
                bid_price: null,
            },
            bidNow: false,
            carData: this.$attrs.cardata,
            seller: this.$attrs.seller,
            biddingCount: this.$attrs.biddingcount,
            biddingDetail: this.$attrs.biddingdetail,
            acceptedBid: this.$attrs.acceptedbid,
            isSubscriptionEnded: this.$attrs.issubscriptionended,
            isUserLoggedIn: this.$attrs.isuserloggedin,
            formErrors: [],
            errors: [],
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
    watch: {
        errors: function (error) {
            if(error.length > 0) {
                this.$_toast(error, 'error')
            }
        },
    },
    methods: {
        async submitForm(payload) {
            this.bidNow = false
            await BidApi.bidRequest(this.carData.id, payload)
                .then((response) => {
                    this.$_toast(null, 'success')
                    this.formErrors = []
                    window.location.reload()
                })
                .catch((error) => {
                    if (error.response.status !== 422) {

                    }
                    this.formErrors = error.response.data.errors
                })
        },

        gotoLoginPage() {
            window.location = '/login'
        },

        gotoPricingPlanPage() {
            window.location = '/pricing-plan'
        }
    }
}
</script>
