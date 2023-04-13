<template>
    <div class="mgnbr_sct">
        <div class="tabs-nav">
            <ul style="cursor: pointer">
                <li :class="tabs.currentBid"><a @click.prevent="switchTab('currentBid')">Current Bids</a></li>
                <li :class="tabs.successfulBid"><a @click.prevent="switchTab('successfulBid')">Successful Bids</a></li>
                <li :class="tabs.declinedBid"><a @click.prevent="switchTab('declinedBid')">Declined Bids</a></li>
            </ul>
        </div>
        <div class="tabs-content">
            <div v-if="tabs.currentBid === 'active'">
                <slot name="current_bid"/>
            </div>
            <div v-if="tabs.successfulBid === 'active'">
                <slot name="successful_bid"/>
            </div>
            <div v-if="tabs.declinedBid === 'active'">
                <slot name="declined_bid"/>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            tabs: {
                currentBid: 'active',
                successfulBid: '',
                declinedBid: ''
            }
        }
    },
    methods: {
        switchTab(tabName) {
            this.tabs = {
                currentBid: '',
                successfulBid: '',
                declinedBid: ''
            }
            this.tabs[tabName] = 'active'
        }
    }
}
</script>
