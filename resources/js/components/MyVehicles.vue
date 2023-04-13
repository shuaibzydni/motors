<template>
    <div class="myvehicle wrapper common_bg">
        <div class="container">
            <div class="my_vehicle_section">
                <div class="tab_section">
                    <ul>
                        <li id="LiveBids"><a href="#" @click.prevent="switchTab('liveBids')" :class="tabs.liveBids">Live Bids</a></li>
                        <li id="AcceptedBids"><a href="#" @click.prevent="switchTab('acceptedBids')" :class="tabs.acceptedBids">Accepted Bids</a></li>
                        <li id="SoldVehicles"><a href="#" @click.prevent="switchTab('soldVehicles')" :class="tabs.soldVehicles">Sold Vehicles</a></li>
                    </ul>
                </div>
                <!--LiveBids-->
                <live-bids v-show="tabs.liveBids"></live-bids>
                <!--LiveBids-->
                <!--AcceptedBids-->
                <accepted-bids v-show="tabs.acceptedBids"></accepted-bids>
                <!--AcceptedBids-->
                <!--SoldVehicles-->
                <sold-bids v-show="tabs.soldVehicles"></sold-bids>
                <!--SoldVehicles-->
            </div>
        </div>
    </div>
</template>

<script>
import LiveBids from '../components/bids/LiveBids'
import AcceptedBids from '../components/bids/AcceptedBids'
import SoldBids from '../components/bids/SoldBids'
export default {
    components: {
        LiveBids,
        AcceptedBids,
        SoldBids
    },
    data() {
        return {
            requiresAuth: true,
            tabs: {
                liveBids: 'active',
                acceptedBids: '',
                soldVehicles: ''
            }
        }
    },
    methods: {
        switchTab(tabName) {
            this.tabs = {
                liveBids: '',
                acceptedBids: '',
                soldVehicles: ''
            }
            this.tabs[tabName] = 'active'
        }
    }
}
</script>
