<template>
    <div class="mgnbr_sct">
        <div class="tabs-nav">
            <ul style="cursor: pointer">
                <li :class="tabs.profileSettings"><a @click.prevent="switchTab('profileSettings')">Profile Settings</a></li>
                <li :class="tabs.changePassword"><a @click.prevent="switchTab('changePassword')">Change Password</a></li>
                <li class="lgt_sgn"><a @click.prevent="$_confirmBuyerLogout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                </li>
            </ul>
        </div>
        <div class="tabs-content">
            <div v-if="tabs.profileSettings === 'active'">
                <slot name="profile_settings"/>
            </div>
            <div v-if="tabs.changePassword === 'active'">
                <slot name="change_password"/>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            tabs: {
                profileSettings: 'active',
                changePassword: ''
            }
        }
    },

    mounted() {
        const tab = new URL(location.href).searchParams.get('tab')
        if (tab && tab === 'cp') {
            this.switchTab('changePassword')
        }
    },

    methods: {
        switchTab(tabName) {
            this.tabs = {
                profileSettings: '',
                changePassword: ''
            }
            this.tabs[tabName] = 'active'
        }
    }
}
</script>
