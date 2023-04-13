<script>
import FavouriteApi from "../api/FavouriteApi";

export default {
    data() {
        return {
            $_loader: null,
        }
    },

    methods: {
        $_showLoader() {
            this.$_hideLoader();
            this.$_loader = this.$loading.show();
        },

        $_hideLoader() {
            if(this.$_loader) {
                this.$_loader.hide();
                this.$_loader = null;
            }
        },
        $_toast(response, icon) {
            let title = 'Success!';
            switch (icon) {
                case 'success':
                    break;
                case 'error':
                    title = 'Error!';
                    break;
                case 'warning':
                    title = 'Warning!';
                    break;
                case 'info':
                    title = 'Info!';
                    break;
                case 'question':
                    title = 'Sure?';
                    break;
                default:
                    icon = 'success';
                    break;
            }
            this.$swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                icon,
                title,
                text: response && response.message ? response.message[0] : '',
            });
        },
        $_confirmDelete() {
            return this.$swal({
                title: 'Are you sure?',
                text: 'You cant revert this action',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            });
        },
        $_confirm(title, text, icon = 'warning', confirmButtonText = 'Submit', showCancelButton = false) {
            return this.$swal({
                title,
                text,
                icon,
                showCancelButton: showCancelButton,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText
            });
        },
        $_showModal(modalName, props = {}) {
            this.$modal.show(`${modalName}`, props)
        },
        $_closeModal(modalName) {
            this.$modal.hide(`${modalName}`)
        },
        $_confirmSellerLogout() {
            this.$swal({
                title: 'Are you sure you want to logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Logout',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    document.getElementById('seller-logout').submit();
                }
            })
        },
        $_confirmBuyerLogout() {
            this.$swal({
                title: 'Are you sure you want to logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Logout',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    document.getElementById('buyer-logout').submit();
                }
            })
        },
        $_discoverVehicle() {
            document.getElementById('discover-vehicle').submit();
        },
        $_removeFilter(filterId, value) {
            if (filterId === 'order_by') {
                if (value === 'asc') {
                    document.getElementById('order_by').value = 'desc'
                } else {
                    document.getElementById('order_by').value = 'asc'
                }
            } else if(filterId === 'model_year') {
                document.getElementById('model_year').value = ''
            } else {
                const make = document.getElementById(value)
                make.parentNode.removeChild(make)
            }

            document.getElementById('discover-vehicle').submit();
        },
        sellYourCar() {
            this.$_showModal('sell-your-car');
        },
        editYourCar(carId) {
            window.$_carId = carId;
            this.$_showModal('edit-your-car');
        },
        getVehicleStatus(type) {
            let data;

            switch (type) {
                case 'unavailable':
                    data = {
                        'type': 'accepted',
                        'value': 'Bid Closed',
                        'class': 'yellow'
                    };
                    break;
                case 'sold':
                    data = {
                        'type': 'sold',
                        'value': 'Sold',
                        'class': 'red'
                    };
                    break;
                default:
                    data = {
                        'type': 'live',
                        'value': 'Live Bidding',
                        'class': ''
                    };
            }

            return data;
        },
        async toggleFavourite(productId, type) {
            await FavouriteApi.favouriteAdd(productId, {type})
                .then((response) => {
                    this.$_toast(null, 'success')
                })
                .catch((error) => {
                    this.$_toast('Something went wrong', 'error')
                })
        }
    }
}
</script>

<style scoped>
.v--modal-overlay {
    z-index: 9999;
}
</style>
