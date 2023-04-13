<template>
    <div>
        <!--banner-->
        <div class="banner about_bg">
            <div class="content_main">
                <img src="/static/sellers/images/vehicle_detail.png" alt=""/>
                <div class="content_lst common_content">
                    <h1>{{ carData.brand_name }} ({{ carData.model_name }} - {{ carData.model_year }})</h1>
                    <ul>
                        <li><a href="#">Home > My Vehicles > </a> <a href="#" class="active-clr">&#x00a0; CarDetail</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--banner-->

        <div class="vahicle_detail_live">
            <div class="container">
                <div class="vehicle_flx">
                    <div class="slider_section">

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

                        <div class="vehicle_top_details">
                            <div class="vehicle_top_price">
                                <p>Vehicle Price</p>
                                <h3>{{ `$${carData.vehicle_price}` }}</h3>
                                <div class="vehicle_status" :class="getVehicleStatus(carData.vehicle_status).class">
                                    <label>Vehicle Status</label><p>{{ getVehicleStatus(carData.vehicle_status).value }}</p>
                                </div>
                            </div>
                            <div class="vahicle_name">
                                <h2>{{ carData.brand_name }} {{ carData.model_name }}</h2>
                                <p>{{ carData.model_year }}</p>
                                <div class="vehicle_btn" v-if="getVehicleStatus(carData.vehicle_status).type === 'live'">
                                    <button class="popup_open" popup-id="post-your-vehicle"
                                            @click.prevent="editYourCar(carData.id)"
                                            style="cursor: pointer"
                                             >Edit Car Detail</button>
                                    <a href="#" @click.prevent="carDelete(carData.id)"><img src="/static/sellers/images/delete.png"/></a>
                                </div>
                                <div class="vehicle_btn" v-if="carData.vehicle_status === 'unavailable' && biddings.length > 0">
                                    <button class="popup_open" popup-id="post-your-vehicle"
                                            @click.prevent="soldBid(biddings[0].id)"
                                            style="cursor: pointer"
                                    >Mark as Sold</button>
                                </div>
                                <div class="sold_details" v-if="getVehicleStatus('vehicle_status').type === 'sold'">
                                    <img src="/static/sellers/images/sold.svg" alt="sold">
                                    <span>Vehicle Sold</span>
                                </div>
                            </div>
                        </div>

                        <div class="list_of_biddings" v-if="carData.vehicle_status === 'available'">
                            <div class="title_flx">
                                <h4>List of Biddings</h4>
                                <p>No. of Total Bids <span>&nbsp; -&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45; &nbsp;</span><span>{{ biddings.length }}</span></p>
                            </div>
                            <div class="bidding_list" v-for="bidding in biddings" :key="bidding.id">
                                <div class="person_detail">
                                    <div class="person_img" >
                                        <img :src="bidding.buyer.avatar" alt="george bailey" style="width: 82px" />
                                    </div>
                                    <div class="person_info">
                                        <h4>{{ bidding.buyer.first_name }}</h4>
                                        <div class="phn_num">{{ bidding.buyer.business_phone }}
                                            <div class="tooltip_section">
                                                <img class="info-icon" src="/static/sellers/images/info-icon.png" alt="info" />
                                                <div class="custom_tooltip">You can see the List of Biddings in Detail Page Once you Accept the any Bid, You will see the Buyer Detail
                                                    <span>&times;</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="date">date : {{ bidding.published_at }}</div>
                                    </div>
                                </div>
                                <div class="pricing_details">
                                    <div class="price_val"><label>Bidding Price</label><p>${{ bidding.bid_price }}</p></div>
                                    <button @click="acceptBid(bidding.id)"><img src="/static/sellers/images/tick-icon.png" alt="tick" />Accept Bid</button>
                                </div>
                            </div>
                        </div>

                        <div class="list_of_biddings vehicle_accepted" v-if="carData.vehicle_status === 'unavailable' || carData.vehicle_status === 'sold'">
                            <div class="title_flx">
                                <h4>List of Biddings</h4>
                                <p>No. of Total Bids <span>&nbsp; --------- &nbsp;</span><span>{{ biddings.length }}</span></p>
                            </div>

                            <template v-if="biddings.length > 0">
                            <p class="sub_title">Accepted Bidding Detail for the Buyer</p>

                            <div class="bidding_list bidding_list_expanded" >
                                <div class="person_detail">
                                    <div class="person_img">
                                        <img :src="biddings[0].buyer.avatar" :alt="biddings[0].buyer.first_name" style="width: 84px;">
                                    </div>
                                    <div class="person_info">
                                        <h4>{{ biddings[0].buyer.first_name }}</h4>
                                        <div class="phn_num">{{ biddings[0].buyer.business_phone }}</div>
                                        <div class="date">date : {{ biddings[0].published_at }}</div>
                                    </div>
                                </div>
                                <div class="pricing_details">
                                    <div class="price_val"><label>Bidding Price</label><p>{{ `$${biddings[0].bid_price}` }}</p></div>
                                </div>
                                <div class="person_contact_section">
                                    <div class="person_contact_details">
                                        <label>Email Address</label>
                                        <p>{{ biddings[0].buyer.email }}</p>
                                    </div>
                                    <div class="person_contact_details">
                                        <label>Address Line</label>
                                        <p>{{ biddings[0].buyer.address_line }}</p>
                                    </div>
                                    <div class="person_contact_details">
                                        <label>State Name</label>
                                        <p>{{ biddings[0].buyer.location.name }}</p>
                                    </div>
                                    <div class="person_contact_details">
                                        <label>Postcode</label>
                                        <p>{{ biddings[0].buyer.postal_code }}</p>
                                    </div>
                                </div>
                            </div>

                            <p class="sub_title" >Previous Biddings</p>

                            <div class="bidding_list" v-for="(bidding, index) in biddings" :key="bidding.id">
                                <div class="person_detail" v-if="index !== 0">
                                    <div class="person_img">
                                        <img :src="bidding.buyer.avatar" :alt="bidding.buyer.first_name" style="width: 84px;">
                                    </div>
                                    <div class="person_info">
                                        <h4>{{ bidding.buyer.first_name }}</h4>
                                        <div class="phn_num">***   ****   ** 4567
                                            <div class="tooltip_section">
                                                <img class="info-icon" src="/static/sellers/images/info-icon.png" alt="info">
                                                <div class="custom_tooltip">You can see the List of Biddings in Detail Page Once you Accept the any Bid, You will see the Buyer Detail
                                                    <span>×</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="date">date : {{ bidding.buyer.published_at }}</div>
                                    </div>
                                </div>
                                <div class="pricing_details" v-if="index !== 0">
                                    <div class="price_val"><label>Bidding Price</label><p>${{ bidding.bid_price }}</p></div>
                                    <button><img src="/static/sellers/images/tick-icon.png" alt="tick">Accept the Bid</button>
                                </div>
                            </div>
                            </template>

                        </div>

                    </div>
                    <div class="category_section">
                        <div class="advertisement">
                            <label>Advertisement ID</label>
                            <p>{{ carData.advertisement_id }}</p>
                        </div>
                        <div class="posted_on">
                            <p>Posted on : {{ carData.published_at }}</p>
                        </div>
                        <div class="gadgets">
                            <h4>Gadgets</h4>
                            <div class="gadget_flx">
                                <div class="gadget_img"><img src="/static/sellers/images/fuel.png" alt="fuel" /></div>
                                <div class="gadgets_content">
                                    <label>Fuel Type</label>
                                    <p>{{ carData.fuel_type }}</p>
                                </div>
                            </div>
                            <div class="gadget_flx">
                                <div class="gadget_img"><img src="/static/sellers/images/odometer.png" alt="Odometer" /></div>
                                <div class="gadgets_content">
                                    <label>Odometer</label>
                                    <p>{{ carData.odometer_mileage }} KM</p>
                                </div>
                            </div>
                            <div class="gadget_flx">
                                <div class="gadget_img"><img src="/static/sellers/images/transmission.png" alt="Transmission" /></div>
                                <div class="gadgets_content">
                                    <label>Transmission</label>
                                    <p>{{ carData.transmission }}</p>
                                </div>
                            </div>
                            <div class="gadget_flx">
                                <div class="gadget_img"><img src="/static/sellers/images/drive-type.png" alt="Drive Type" /></div>
                                <div class="gadgets_content">
                                    <label>Drive Type</label>
                                    <p>{{ carData.drive_type }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="vehicle_overview">
                            <h4>Vehicle Overview</h4>
                            <label>Make</label>
                            <p>{{ carData.brand_name }}</p>
                            <label>Body Type</label>
                            <p>{{ carData.body_type }}</p>
                            <label>Model </label>
                            <p>{{ carData.model_name }}</p>
                            <label>Model Description</label>
                            <p>{{ carData.model_description }}</p>
                            <label>Model Year</label>
                            <p>{{ carData.model_year }}</p>
                            <label>Transmission</label>
                            <p>{{ carData.transmission }}</p>
                            <label>Drive Type</label>
                            <p>{{ carData.drive_type }}</p>
                            <label>Fuel Type</label>
                            <p>{{ carData.fuel_type }}</p>
                            <label>Service Log Book</label>
                            <p><a target="_blank" v-if="carData.service_log_book" :href="carData.service_log_book">{{ `view` }}</a></p>
                            <label>Owner's Manual</label>
                            <p><a target="_blank" v-if="carData.owners_manual" :href="carData.owners_manual">{{ `view` }}</a></p>
                            <label>Current Odometer / Mileage</label>
                            <p>{{ carData.odometer_mileage }}KM</p>
                            <label>Vehicle VIN</label>
                            <p>{{ carData.vehicle_vin }}</p>
                            <label>Vehicle Price</label>
                            <p class="vehicle_price">{{ `$${carData.vehicle_price}` }}</p>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/splide/dist/css/themes/splide-default.min.css';
import CarApi from "../api/CarApi";
import BidApi from "../api/BidApi";
export default {
    components: {
        Splide,
        SplideSlide,
    },
    data() {
        return {
            carData: this.$attrs.cardata,
            biddings: this.$attrs.biddings,
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
    watch: {
        errors: function (error) {
            if(error.length > 0) {
                this.$_toast(error, 'error')
            }
        },
    },
    mounted() {
        this.$refs.primary.sync( this.$refs.secondary.splide );
    },
    methods: {
        carDelete(carId) {
            this.$_confirmDelete().then(async (confirm) => {
                if (confirm.value) {
                    await CarApi.carDelete(carId)
                        .then(response => {
                            this.errors = []
                            window.location = '/my-vehicles'
                        })
                        .catch(error => {
                            this.errors = error.response ? error.response.data.errors : []
                        });
                }
            })
        },

        acceptBid(bidId) {
            this.$swal({
                title: 'Are you sure you want to accept this bid?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Accept',
            }).then(async (result) => {
                if (result.value) {
                    await BidApi.bidAccept(bidId)
                        .then(response => {
                            this.errors = []
                            window.location.reload()
                        })
                        .catch(error => {
                            this.errors = error.response ? error.response.data.errors : []
                        });
                }
            })
        },

        soldBid(bidId) {
            this.$swal({
                title: 'Are you sure you want mark as sold? This action cannot be undone',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Mark as Sold',
            }).then(async (result) => {
                if (result.value) {
                    await BidApi.bidSold(bidId)
                        .then(response => {
                            this.errors = []
                            window.location.reload()
                        })
                        .catch(error => {
                            this.errors = error.response ? error.response.data.errors : []
                        });
                }
            })
        },
    }
}
</script>
